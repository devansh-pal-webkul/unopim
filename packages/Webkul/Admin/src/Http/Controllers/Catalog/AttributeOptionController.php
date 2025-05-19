<?php

namespace Webkul\Admin\Http\Controllers\Catalog;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\Rule;
use Webkul\Admin\DataGrids\Catalog\AttributeDataGrid;
use Webkul\Admin\DataGrids\Catalog\AttributeOptionDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Http\Requests\MassDestroyRequest;
use Webkul\Attribute\Repositories\AttributeOptionRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Attribute\Rules\NotSupportedAttributes;
use Webkul\Core\Repositories\LocaleRepository;
use Webkul\Core\Rules\Code;
use Webkul\Product\Repositories\ProductRepository;

class AttributeOptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected AttributeOptionRepository $attributeOptionRepository,
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(int $id)
    {
        return app(AttributeOptionDataGrid::class)->setAttributeId($id)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'code' => ['required', 'not_in:type,attribute_family_id', 'unique:attributes,code', new Code, new NotSupportedAttributes],
            'type' => 'required',
        ]);

        $requestData = request()->all();

        Event::dispatch('catalog.attribute.create.before');

        $attribute = $this->attributeRepository->create($requestData);

        Event::dispatch('catalog.attribute.create.after', $attribute);

        session()->flash('success', trans('admin::app.catalog.attributes.create-success'));

        return redirect()->route('admin.catalog.attributes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $attributeId, int $id)
    {
        $option = $this->attributeOptionRepository->find($id)->toArray();

        if (! $option) {
            abort(404);
        }

        foreach ($option['translations'] as $key => $translation) {
            $option['locales'][$translation['locale']] = $translation['label'] ?? '';
        }

        return new JsonResponse([
            'option' => $option,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(int $attributeId, int $id)
    {
        //TODO: update attribute option translations
        $requestData = request()->except(['code', 'attribute_id', 'id', 'translations']);

        Event::dispatch('catalog.attribute.option.update.before', $id);

        $requestData['label'] = $requestData['locales'];

        $option = $this->attributeOptionRepository->update($requestData, $id);

        Event::dispatch('catalog.attribute.option.update.after', $option);

        return new JsonResponse([
            'message' => trans('admin::app.catalog.attributes.update-success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $attributeId, int $id): JsonResponse
    {
        //TODO: add validation before delete to check if it is not being used in any product
        $attribute = $this->attributeOptionRepository->findOrFail($id);

        try {
            Event::dispatch('catalog.attribute.option.delete.before', $id);

            $this->attributeOptionRepository->delete($id);

            Event::dispatch('catalog.attribute.option.delete.after', $id);

            return new JsonResponse([
                'message' => trans('admin::app.catalog.attribute.option.delete-success'),
            ]);
        } catch (\Exception $e) {
            report($e);

            return new JsonResponse(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resources from database.
     */
    public function massDestroy(MassDestroyRequest $massDestroyRequest): JsonResponse
    {
        $indices = $massDestroyRequest->input('indices');
        $delete = false;

        foreach ($indices as $index) {
            Event::dispatch('catalog.attribute.delete.before', $index);

            $attribute = $this->attributeRepository->find($index);

            if (! $attribute->canBeDeleted()) {
                continue;
            }

            $this->attributeRepository->delete($index);
            $delete = true;

            Event::dispatch('catalog.attribute.delete.after', $index);
        }

        if (! $delete) {
            return new JsonResponse([
                'message' => trans('admin::app.catalog.attributes.index.datagrid.mass-delete-failed'),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => trans('admin::app.catalog.attributes.index.datagrid.mass-delete-success'),
        ]);
    }
}

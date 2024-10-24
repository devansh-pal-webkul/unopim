<?php

namespace Webkul\Admin\Http\Controllers\Catalog\Options;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Repositories\AttributeFamilyRepository;
use Webkul\Attribute\Repositories\AttributeOptionRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Category\Repositories\CategoryFieldOptionRepository;
use Webkul\Core\Eloquent\Repository;
use Webkul\Core\Eloquent\TranslatableModel;

class AjaxOptionsController extends Controller
{
    const DEFAULT_PER_PAGE = 20;

    /**
     * Return instance of Controller
     */
    public function __construct(
        protected CategoryFieldOptionRepository $categoryFieldOptionsRepository,
        protected AttributeOptionRepository $attributeOptionsRepository,
        protected AttributeFamilyRepository $attributeFamilyRepository,
        protected AttributeRepository $attributeRepository
    ) {}

    /**
     * Fetch and format options for async select and multiselect handlers
     */
    public function getOptions()
    {
        $attributeId = request()->get('attributeId');
        $entityName = request()->get('entityName');
        $page = request()->get('page');
        $query = request()->get('query') ?? '';

        $queryParams = request()->except(['page', 'query', 'entityName', 'attributeId']);

        $options = $this->getOptionsByParams($attributeId, $entityName, $page, $query, $queryParams);

        $currentLocaleCode = core()->getRequestedLocaleCode();

        $formattedoptions = [];

        foreach ($options as $option) {
            $formattedoptions[] = $this->formatOption($option, $currentLocaleCode);
        }

        return new JsonResponse([
            'options'  => $formattedoptions,
            'page'     => $options->currentPage(),
            'lastPage' => $options->lastPage(),
        ]);
    }

    /**
     * Fetch options according to parameters for search, page and id
     */
    protected function getOptionsByParams(
        int|string|null $id,
        string $entityName,
        int|string $page,
        string $query = '',
        ?array $queryParams = []
    ): LengthAwarePaginator {
        $repository = $this->getRepository($entityName);

        if ($id) {
            $repository = $repository->where($entityName.'_id', $id);
        }

        if (! empty($query)) {
            $repository = $repository->where(function ($queryBuilder) use ($query) {
                $queryBuilder->whereTranslationLike('label', '%'.$query.'%')
                    ->orWhere('code', $query);
            });
        }

        $searchIdentifiers = isset($queryParams['identifiers']['columnName']) ? $queryParams['identifiers'] : [];

        if (! empty($searchIdentifiers)) {
            $repository = $repository->whereIn(
                $searchIdentifiers['columnName'],
                is_array($searchIdentifiers['values']) ? $searchIdentifiers['values'] : [$searchIdentifiers['values']]
            );
        }

        return $repository->orderBy('id')->paginate(self::DEFAULT_PER_PAGE, ['*'], 'paginate', $page);
    }

    /**
     * TODO: Add attribute, family, attribute group, category, products support here
     * Get Repository according to entity name
     */
    private function getRepository(string $entityName): Repository
    {
        return match ($entityName) {
            'attributes'     => $this->attributeRepository,
            'attribute'      => $this->attributeOptionsRepository,
            'category_field' => $this->categoryFieldOptionsRepository,
            'family'         => $this->attributeFamilyRepository,
            default          => throw new \Exception('Not implemented for '.$entityName)
        };
    }

    /**
     * Get translated label for the entity
     */
    protected function getTranslatedLabel(string $currentLocaleCode, TranslatableModel $option): string
    {
        $translation = $option->translate($currentLocaleCode);

        return $translation?->label ?? $translation?->name;
    }

    /**
     * format option for select component
     */
    protected function formatOption(Model $option, string $currentLocaleCode)
    {
        $translatedOptionLabel = $this->getTranslatedLabel($currentLocaleCode, $option);

        return [
            'id'    => $option->id,
            'code'  => $option->code,
            'label' => ! empty($translatedOptionLabel) ? $translatedOptionLabel : "[{$option->code}]",
            ...$option->makeHidden(['translations'])->toArray(),
        ];
    }
}

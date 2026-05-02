<?php

namespace App\Livewire\Bases;

use App\Traits\Handles\HandlesPostActionNotifications;
use Livewire\{Attributes\Layout, Component, WithPagination};
use ReflectionClass;
use ReflectionProperty;

#[Layout('layouts.personal-pages', ['padding' => '0px', 'important' => '!important', 'type' => ''])]
abstract class BaseListType extends Component
{
    use HandlesPostActionNotifications, WithPagination;

    public string $type;

    public string $search = '';

    public string $filter = 'All';

    public string $sortField;

    public string $sortDirection = 'desc';

    public mixed $perPage = 5;

    public int $infiniteLimit = 5;

    protected array $queryString = ['search' => ['except' => ''], 'sortField', 'sortDirection' => ['alwaysShow' => false], 'perPage', 'filter' => ['except' => 'All']];

    /** @var array */
    protected $listeners = ['refreshList' => '$refresh', 'filterUpdated' => '$refresh'];

    protected ?string $view = null;

    protected ?string $key = null;

    protected mixed $service = null;

    public function mount()
    {
        $this->sortField ??= $this->defaultSortField();
        $this->type ??= $this->getType();

        if ($this->perPage === 'all') {
            $this->infiniteLimit = 5;
        }
    }

    public function init(): void {}

    public function loadData(): void {}

    abstract protected function defaultSortField(): string;

    protected function getService()
    {
        if ($this->service !== null) {
            return $this->service;
        }

        $serviceClass = 'App\\Services\\ListType\\' . str(class_basename($this))->singular()->toString() . 'Service';

        return app($serviceClass);
    }

    protected function getType(): string
    {
        return $this->type ?? str(class_basename($this))->singular()->snake()->toString();
    }

    protected function getRenderConfig(): array
    {
        $plural = str(class_basename($this))->snake()->toString();

        return ['view' => $this->view ?? "livewire.pages.$plural", 'key' => $this->key ?? $plural];
    }

    protected function getPublicPropertiesDefinedBySubClass()
    {
        $payload = [];

        $properties = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if ($property->getDeclaringClass()->getName() === static::class) {
                $payload[] = $property->getName();
            }
        }

        return $payload;
    }

    public function placeholder()
    {
        return view('components.pages.list-type');
    }

    public function updated(string $name, mixed $value)
    {
        if (collect(['sortField', 'sortDirection', 'search', 'filter', 'perPage'])->contains($name)) {
            $this->resetPage();
        }

        if ($name === 'search' || ($name === 'perPage' && $value === 'all')) {
            $this->infiniteLimit = 5;
        }
    }

    public function loadMore()
    {
        $this->infiniteLimit += 5;
    }

    protected function getQueryLimit()
    {
        return ($this->perPage === 'all') ? $this->infiniteLimit : $this->perPage;
    }

    public function render()
    {
        $config = $this->getRenderConfig();
        $service = $this->getService();
        $data = $service->handle($this->search, $this->filter, $this->sortField, $this->sortDirection, $this->getQueryLimit());
        $viewPath = $config['view'];

        return view($viewPath, [$config['key'] => $data, 'type' => $this->getType(), 'filter' => $this->filter]);
    }
}

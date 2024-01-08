<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Experience;
use MoonShine\Attributes\Icon;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Date;
use MoonShine\Fields\ID;
use MoonShine\Fields\Number;
use MoonShine\Fields\RangeSlider;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

#[Icon('heroicons.academic-cap')]

class MoonShineExperience extends ModelResource {
    public string $model = Experience::class;

    public string $column = 'TechnologyName';

    protected bool $isAsync = true;
    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    public function title(): string
    {
        return 'Experience';
    }

    public function fields(): array
    {
        return [
            Block::make('', [
                ID::make()->sortable(),
                Text::make('TechnologyName', 'TechnologyName')
                    ->required(),
                Text::make('Language', 'Language')
                    ->required(),
                Textarea::make('Description', 'Description')
                    ->required(),
                Date::make('StartDate', 'StartDate')
                    ->required()
                    ->format('d.m.Y'),
                Number::make('KnowledgeLevel', 'KnowledgeLevel')
                    ->min(0)
                    ->max(10)
                    ->required(),
            ]),
        ];
    }

    /**
     * @return array{name: string}
     */
    public function rules($item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['id', 'TechnologyName'];
    }
}

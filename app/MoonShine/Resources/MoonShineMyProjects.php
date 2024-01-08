<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Experience;
use App\Models\Project;
use MoonShine\Attributes\Icon;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Date;
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\RangeSlider;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;

#[Icon('heroicons.trash')]

class MoonShineMyProjects extends ModelResource {
    public string $model = Project::class;

    public string $column = 'ProjectName';

    protected bool $isAsync = true;
    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';
    protected bool $createInModal = false;

    protected bool $editInModal = false;

    public function title(): string
    {
        return 'My Projects';
    }

    public function fields(): array
    {
        return [
            Block::make('', [
                ID::make()->sortable()->showOnExport(),
                Text::make('Name', 'ProjectName')
                    ->required()
                    ->showOnExport(),
                Text::make('Short Description', 'ProjectShortDescription')
                    ->required()
                    ->showOnExport(),
                Textarea::make('Long Description', 'ProjectLongDescription')
                    ->hideOnIndex()
                    ->required()
                    ->showOnExport(),
                Date::make('Creation Date', 'ProjectCreationDay')
                    ->required()
                    ->format('d.m.Y')
                    ->showOnExport(),
                Text::make('URL', 'ProjectUrl')
                    ->showOnExport(),
                Text::make('Source URL', 'ProjectSourceUrl')
                    ->showOnExport(),
                Json::make('Technologies', 'ProjectTechnologies')
                    ->onlyValue()
                    ->showOnExport(),
                Json::make('Images', 'ProjectImages')
                    ->onlyValue()
                    ->showOnExport(),
                Checkbox::make('Deployed?', 'ProjectDeployed')
                    ->showOnExport(),
                Number::make('Difficulty', 'ProjectDifficulty')
                    ->min(0)
                    ->max(10)
                    ->required()
                    ->showOnExport(),
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

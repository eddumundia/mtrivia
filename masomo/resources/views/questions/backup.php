@extends('layouts.app')

@section('content')
<ul>
    @foreach($questions as $question)
        <li>{{$question->question}}</li>
    @endforeach
</ul>
@endsection
 <a href="{{$question->id}}/proceed/{{$value->id}}/{{$fk_random}}">  <li class="<?= ($value->correct == 1)?'correct':''?>"><?= $value->answer;?> <?= ($value->correct == 1)?"<i class=''></i>":"";?></li></a>
           

<?php $grid = new \Nayjest\Grids\Grid(
    (new \Nayjest\Grids\GridConfig())
        # Grids name used as html id, caching key, filtering GET params prefix, etc
        # If not specified, unique value based on file name & line of code will be generated
        ->setName('my_report')
        # See all supported data providers in sources
        ->setDataProvider(new \Nayjest\Grids\EloquentDataProvider($query))
        # Setup caching, value in minutes, turned off in debug mode
        ->setCachingTime(5) 
        # Setup table columns
        ->setColumns([
            # simple results numbering, not related to table PK or any obtained data
            new \Nayjest\Grids\IdFieldConfig,
            (new  \Nayjest\Grids\IdFieldConfig)
                ->setName('login')
                # will be displayed in table header
                ->setLabel('Login')
                # That's all what you need for filtering. 
                # It will create controls, process input 
                # and filter results (in case of EloquentDataProvider -- modify SQL query)
                ->addFilter(
                    (new \Nayjest\Grids\FilterConfig)
                        ->setName('login')
                        ->setOperator(\Nayjest\Grids\FilterConfig::OPERATOR_LIKE)
                )
                # optional, 
                # use to prettify output in table cell 
                # or print any data located not in results field matching column name
                ->setCallback(function ($val, ObjectDataRow $row) {
                    if ($val) {
                        $icon  = "<span class='glyphicon glyphicon-user'></span>&nbsp;";
                        $user = $row->getSrc();
                        return $icon . HTML::linkRoute('users.profile', $val, [$user->id]);
                    }
                })
                # sorting buttons will be added to header, DB query will be modified
                ->setSortable(true)
            ,
            (new \Nayjest\Grids\FieldConfig)
                ->setName('fk_subject')
                ->setLabel('fk_subject')
               // ->addFilter(
//                    (new \Nayjest\Grids\SelectFilterConfig)
//                        ->setOptions(User::getStatuses())
               // )
            ,
            (new \Nayjest\Grids\FieldConfig)
                ->setName('fk_class')
                ->setLabel('fk_class')
//                ->addFilter(
//                    (new SelectFilterConfig)
//                        ->setName('country')
//                        ->setOptions(get_countries_list())
//                )
            ,
            (new \Nayjest\Grids\FieldConfig)
                ->setName('registration_date')
                ->setLabel('Registration date')
                ->setSortable(true)
            ,
            (new \Nayjest\Grids\FieldConfig)
                ->setName('comments_count')
                ->setLabel('Comments')
                ->setSortable(true)
            ,
            (new \Nayjest\Grids\FieldConfig)
                ->setName('posts_count')
                ->setLabel('Posts')
                ->setSortable(true)
            ,
        ])
        # Setup additional grid components
        ->setComponents([
            # Renders table header (table>thead)
            (new \Nayjest\Grids\Components\THead)
                # Setup inherited components
                ->setComponents([
                    # Add this if you have filters for automatic placing to this row
                    new \Nayjest\Grids\Components\FiltersRow,
                    # Row with additional controls
                    (new \Nayjest\Grids\Components\OneCellRow)
                        ->setComponents([
                            # Control for specifying quantity of records displayed on page
                            (new \Nayjest\Grids\Components\RecordsPerPage)
                                ->setVariants([
                                    50,
                                    100,
                                    1000
                                ])
                            ,
                            # Control to show/hide rows in table
                            (new \Nayjest\Grids\Components\ColumnsHider)
                                ->setHiddenByDefault([
                                    'activated_at',
                                    'updated_at',
                                    'registration_ip',
                                ])
                            ,
                            # Submit button for filters. 
                            # Place it anywhere in the grid (grid is rendered inside form by default).
                            (new \Nayjest\Grids\Components\HtmlTag)
                                ->setTagName('button')
                                ->setAttributes([
                                    'type' => 'submit',
                                    # Some bootstrap classes
                                    'class' => 'btn btn-primary'
                                ])
                                ->setContent('Filter')
                        ])
                        # Components may have some placeholders for rendering children there.
                        ->setRenderSection(\Nayjest\Grids\Components\THead::SECTION_BEGIN)
                ])
            ,
            # Renders table footer (table>tfoot)
            (new \Nayjest\Grids\Components\TFoot())
                ->addComponent(
                    # TotalsRow component calculates totals on current page
                    # (max, min, sum, average value, etc)
                    # and renders results as table row.
                    # By default there is a sum.
                    new \Nayjest\Grids\Components\TotalsRow([
                        'comments',
                        'posts',
                    ])
                )
                ->addComponent(
                    # Renders row containing one cell 
                    # with colspan attribute equal to the table columns count
                    (new \Nayjest\Grids\Components\OneCellRow)
                        # Pagination control
                        ->addComponent(new \Nayjest\Grids\Components\Laravel5\Pager)
                )
        ])
);?>

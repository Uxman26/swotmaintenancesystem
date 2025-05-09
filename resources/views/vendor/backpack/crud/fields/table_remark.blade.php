<!-- Backpack Table Field Type -->

<?php
$max = isset($field['max']) && (int) $field['max'] > 0 ? $field['max'] : -1;
$min = isset($field['min']) && (int) $field['min'] > 0 ? $field['min'] : -1;
$item_name = strtolower(isset($field['entity_singular']) && !empty($field['entity_singular']) ? $field['entity_singular'] : $field['label']);

$items = old(square_brackets_to_dots($field['name'])) ?? ($field['value'] ?? ($field['default'] ?? ''));

// make sure no matter the attribute casting
// the $items variable contains a properly defined JSON string
if (is_array($items)) {
    if (count($items)) {
        $items = json_encode($items);
    } else {
        $items = '[]';
    }
} elseif (is_string($items) && !is_array(json_decode($items))) {
    $items = '[]';
}

// make sure columns are defined
if (!isset($field['columns'])) {
    $field['columns'] = ['value' => 'Value'];
}

$field['wrapper'] = $field['wrapper'] ?? ($field['wrapperAttributes'] ?? []);
$field['wrapper']['data-field-type'] = 'table';
$field['wrapper']['data-field-name'] = $field['name'];
?>
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')

<input class="array-json" type="hidden" data-init-function="bpFieldInitTableElement" name="{{ $field['name'] }}"
    value="{{ $items }}" data-max="{{ $max }}" data-min="{{ $min }}"
    data-maxErrorTitle="{{ trans('backpack::crud.table_cant_add', ['entity' => $item_name]) }}"
    data-maxErrorMessage="{{ trans('backpack::crud.table_max_reached', ['max' => $max]) }}" id="get_element">

<div class="array-container form-group">

    <table class="table table-sm table-striped m-b-0">

        <thead>
            <tr>
                <th class="text-center"> {{-- <i class="la la-sort"></i> --}} </th>
                @foreach ($field['columns'] as $column)
                    <th style="font-weight: 600!important;">
                        {{ $column }}
                    </th>
                @endforeach
                <th class="text-center"> {{-- <i class="la la-trash"></i> --}} </th>
            </tr>
        </thead>

        <tbody class="table-striped items sortableOptions">

            <tr class="array-row clonable" style="display: none;">
                <td>
                </td>
                @foreach ($field['columns'] as $column => $label)
                    <td>
                        <input class="form-control form-control-sm remark-input" type="text" {{ backpack_user()->hasRole(['Admin', 'Super Admin'])? '': 'disabled'}}
                            data-cell-name="item.{{ $column }}" disabled>
                    </td>
                @endforeach
                <td>
                    @if (backpack_user()->hasRole(['Admin', 'Super Admin']))
                    <button class="btn btn-sm btn-light removeItem" type="button"><span class="sr-only">delete
                            item</span><i class="la la-trash" role="presentation" aria-hidden="true"></i></button>
                    @endif
                </td>
            </tr>

        </tbody>

    </table>

    @if (backpack_user()->hasRole(['Admin', 'Super Admin']))
    <div class="array-controls btn-group m-t-10">
        <button class="btn btn-sm btn-light" type="button" data-button-type="addItem"><i class="la la-plus"></i>
            {{ trans('backpack::crud.add') }} {{ $item_name }}</button>
    </div>
    <div class="array-controls btn-group">
        <button class="btn btn-sm btn-light" type="button" onclick='checkStatusRemark();'><i class="la la-edit"></i>
         Edit Remark</button>
    </div>
    @endif
</div>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- YOUR JS HERE --}}
        <script type="text/javascript" src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}"></script>
        <script type="text/javascript">
             function checkStatusRemark(){
                if(document.getElementsByClassName("remark-input")[0].disabled==true){
                  const buttons = document.getElementsByClassName('remark-input');
                  for (let i = 0; i < buttons.length; i++) {
                    buttons[i].disabled=false;
                  }
                }else{
                  const buttons = document.getElementsByClassName('remark-input');
                  for (let i = 0; i < buttons.length; i++) {
                    buttons[i].disabled=true;
                  }
                }
             }
        </script>
        <script>

            // $("#status_event").on('change', function(){
            //     var new_status = $('#status_event').val(); 
            //     var case_detail_id = window.location.href.match(/[0-9]+/);
            //     var element = $("#get_element");
            //     var $tableWrapper = element.parent('[data-field-type=table]');
            //     $.ajax({
            //            type:'GET',
            //            url: "{{ route('fetch.remark') }}",
            //            data:{case_detail_id: case_detail_id, new_status: new_status},
            //            success:function(response){
            //               var $rows = response;
            //               console.log($rows);     
            //                // add rows with the information from the database
            //                if ($rows != '[]') {
            //                    $.each($rows, function(key) {           
            //                        // addItem();           
            //                        $.each(this, function(column, value) {
            //                            if (column == 'section') {
            //                                $tableWrapper.find('tbody tr:last').find('select[data-cell-name="item.' +
            //                                    column +
            //                                    '"]').val(value);
            //                            } else {
            //                                $tableWrapper.find('tbody tr:last').find('input[data-cell-name="item.' +
            //                                    column +
            //                                    '"]').val(value);
            //                            }
            //                        });           

            //                        // if it's the last row, update the JSON
            //                        // if ($rows.length == key + 1) {
            //                        //     updateTableFieldJson();
            //                        // }
            //                    });
            //                }
            //            }
            //     });   
            // });

            function bpFieldInitTableElement() {
                var element = $("#get_element");
                var $tableWrapper = element.parent('[data-field-type=table]');
                var $rows = (element.attr('value') != '') ? $.parseJSON(element.attr('value')) : '';
                var $max = element.attr('data-max');
                var $min = element.attr('data-min');
                var $maxErrorTitle = element.attr('data-maxErrorTitle');
                var $maxErrorMessage = element.attr('data-maxErrorMessage');
                // add rows with the information from the database
                if ($rows != '[]') {
                    $.each($rows, function(key) {

                        addItem();

                        $.each(this, function(column, value) {
                            if (column == 'section') {
                                $tableWrapper.find('tbody tr:last').find('select[data-cell-name="item.' +
                                    column +
                                    '"]').val(value);
                            } else {
                                $tableWrapper.find('tbody tr:last').find('input[data-cell-name="item.' +
                                    column +
                                    '"]').val(value);
                            }
                        });

                        // if it's the last row, update the JSON
                        if ($rows.length == key + 1) {
                            updateTableFieldJson();
                        }
                    });
                }

                // add minimum rows if needed
                var itemCount = $tableWrapper.find('tbody tr').not('.clonable').length;
                if ($min > 0 && itemCount < $min) {
                    $rowsToAdd = Number($min) - Number(itemCount);

                    for (var i = 0; i < $rowsToAdd; i++) {
                        addItem();
                    }
                }

                $tableWrapper.find('.sortableOptions').sortable({
                    handle: '.sort-handle',
                    axis: 'y',
                    helper: function(e, ui) {
                        ui.children().each(function() {
                            $(this).width($(this).width());
                        });
                        return ui;
                    },
                    update: function(event, ui) {
                        updateTableFieldJson();
                    }
                });


                $tableWrapper.find('[data-button-type=addItem]').click(function() {
                    if ($max > -1) {
                        var totalRows = $tableWrapper.find('tbody tr').not('.clonable').length;

                        if (totalRows < $max) {
                            addItem();
                            updateTableFieldJson();
                        } else {
                            new Noty({
                                type: "warning",
                                text: "<strong>" + $maxErrorTitle + "</strong><br>" + $maxErrorMessage
                            }).show();
                        }
                    } else {
                        addItem();
                        updateTableFieldJson();
                    }

                    const buttons = document.getElementsByClassName('remark-input');
                    for (let i = 0; i < buttons.length; i++) {
                        if( i == (buttons.length - 1)){
                            buttons[i].disabled=false;
                        }
                    }
                });

                function addItem() {
                    //get occurance of class
                    var count = $('input.remark-input').length;

                    $tableWrapper.find('tbody').append($tableWrapper.find('tbody .clonable').clone().show().removeClass(
                        'clonable').addClass('row-remark-item-' + count));
                }

                $tableWrapper.on('click', '.removeItem', function() {
                    var totalRows = $tableWrapper.find('tbody tr').not('.clonable').length;
                    if (totalRows > $min) {
                        $(this).closest('tr').remove();
                        updateTableFieldJson();
                        return false;
                    }
                });

                $tableWrapper.find('tbody').on('keyup', function() {
                    updateTableFieldJson();
                });
                $tableWrapper.find('select').on('change', function() {
                    updateTableFieldJson();
                });

                function updateTableFieldJson() {
                    var $rows = $tableWrapper.find('tbody tr').not('.clonable');
                    var $hiddenField = $tableWrapper.find('input.array-json');

                    var json = '[';
                    var otArr = [];
                    var tbl2 = $rows.each(function(i) {
                        x = $(this).children().closest('td').find('input, select');
                        var itArr = [];
                        var is_empty = false;
                        x.each(function() {
                            if (!this.value.length)
                                is_empty = true;

                            var key = $(this).attr('data-cell-name').replace('item.', '');
                            itArr.push('"' + key + '":' + JSON.stringify(this.value));

                        });
                        !is_empty && otArr.push('{' + itArr.join(',') + '}');
                    })
                    json += otArr.join(",") + ']';

                    var totalRows = $rows.length;

                    $hiddenField.val(totalRows ? json : null);
                }

                // on page load, make sure the input has the old values
                updateTableFieldJson();
            }
        </script>
        <script>
            $("select[name='status']").on('change', function () {
                var value = this.value;
                console.log('Value : ' + value);

                $('.remark-input').each(function(){
                    //current element
                    var className = $(this)[0].className;
                    console.log('Current Class Name : ' + className);

                    //parent element
                    var parent = $(this).closest('.array-row');
                    console.log('Parent Class Name : ' + parent[0].className);

                    //if parent class name contain "clonable" class ignore
                    var substring = "clonable";
                    if( !(parent[0].className.indexOf(substring) !== -1 ))
                    {
                        var rowName = parent[0].className.replace("array-row ", "");
                        $('.' + rowName).remove();
                    }
                });
            });
        </script>
    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

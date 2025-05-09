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
    data-maxErrorMessage="{{ trans('backpack::crud.table_max_reached', ['max' => $max]) }}">

<div class="array-container form-group">

    <table class="table table-sm table-striped m-b-0">

        <thead>
            <tr>
                <td></td>
                @foreach ($field['columns'] as $column)
                    <th style="font-weight: 600!important;">
                        {{ $column }}
                    </th>
                @endforeach
                <th class="text-center"> {{-- <i class="la la-sort"></i> --}} </th>
                <th class="text-center"> {{-- <i class="la la-trash"></i> --}} </th>
            </tr>
        </thead>

        <tbody class="table-striped items sortableOptions">

            <tr class="array-row clonable" style="display: none;">
                @foreach ($field['columns'] as $column => $label)
                    @if ($loop->first)
                        <td style="width:2px;">
                            <i style="margin-top: 7px;" class="las la-arrows-alt"></i>
                        </td>
                    @endif
                    <td>
                        @if ($column == 'type')
                            <select class="form-control form-control-sm" data-cell-name="item.{{ $column }}">
                                <option value="less">Less</option>
                                <option value="plus">Plus</option>
                            </select>
                        @elseif($column == 'price')
                            <input class="form-control form-control-sm" type="number" step=".01"
                                data-cell-name="item.{{ $column }}">
                        @elseif($column == 'amount')
                            <input class="form-control form-control-sm d-none d-amount" type="number" step=".01"
                                data-cell-name="item.{{ $column }}">
                        @elseif($column == 'm_amount')
                            <input class="form-control form-control-sm d-none d-m-amount" type="number" step=".01"
                                data-cell-name="item.{{ $column }}">
                        @elseif($column == 't_d_month')
                            <input class="form-control form-control-sm d-none d-t-d-month" type="number" step="1"
                                data-cell-name="item.{{ $column }}">
                        @elseif($column == 't_f_month')
                            <input class="form-control form-control-sm d-none d-t-f-month" type="number" step="1"
                                data-cell-name="item.{{ $column }}">
                        @elseif ($column == 'prorated')
                            <select class="form-control form-control-sm pro-select"
                                data-cell-name="item.{{ $column }}">
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>
                                <option selected value="no">No</option>
                            </select>
                        @elseif ($column == 'cod' || $column == 'ed')
                            <input class="form-control form-control-sm d-none d-dates" type="date"
                                data-cell-name="item.{{ $column }}">
                        @else
                            <input class="form-control form-control-sm" type="text"
                                data-cell-name="item.{{ $column }}">
                        @endif
                    </td>
                @endforeach
                <td>
                    <span class="btn btn-sm btn-light sort-handle pull-right"><span class="sr-only">sort item</span><i
                            class="la la-sort" role="presentation" aria-hidden="true"></i></span>
                </td>
                <td>
                    <button class="btn btn-sm btn-light removeItem" type="button"><span class="sr-only">delete
                            item</span><i class="la la-trash" role="presentation" aria-hidden="true"></i></button>
                </td>
            </tr>

        </tbody>

    </table>

    <div class="array-controls btn-group m-t-10">
        <button class="btn btn-sm btn-light" type="button" data-button-type="addItem"><i class="la la-plus"></i>
            {{ trans('backpack::crud.add') }} {{ $item_name }}</button>
    </div>

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

        <script>
            function bpFieldInitTableElement(element) {
                var $tableWrapper = element.parent('[data-field-type=table]');
                var $rows = (element.attr('value') != '') ? $.parseJSON(element.attr('value')) : '';
                var $max = element.attr('data-max');
                var $min = element.attr('data-min');
                var $maxErrorTitle = element.attr('data-maxErrorTitle');
                var $maxErrorMessage = element.attr('data-maxErrorMessage');

                // Listener to display accurate fields as per selected prorated value
                $tableWrapper.on('change', '.pro-select', function() {
                    if ($(this).val() == 'daily') {
                        $(this).closest('tr').find('.d-m-amount,.d-t-d-month,.d-t-f-month').addClass('d-none');
                        $(this).closest('tr').find('.d-dates,.d-amount').removeClass('d-none');
                    } else if ($(this).val() == 'monthly') {
                        $(this).closest('tr').find('.d-dates').removeClass('d-none');
                        $(this).closest('tr').find('.d-amount').addClass('d-none');
                        $(this).closest('tr').find('.d-m-amount,.d-t-d-month,.d-t-f-month').removeClass('d-none');
                    } else {
                        $(this).closest('tr').find('.d-dates,.d-amount').addClass('d-none');
                        $(this).closest('tr').find('.d-m-amount,.d-t-d-month,.d-t-f-month').addClass('d-none');
                    }
                });

                // add rows with the information from the database
                if ($rows != '[]') {
                    $.each($rows, function(key) {

                        addItem();

                        $.each(this, function(column, value) {
                            if (column == 'type') {
                                $tableWrapper.find('tbody tr:last').find('select[data-cell-name="item.' +
                                    column +
                                    '"]').val(value);
                            } else if (column == 'prorated') {
                                $tableWrapper.find('tbody tr:last').find('select[data-cell-name="item.' +
                                    column +
                                    '"]').val(value);
                                if (value == 'daily')
                                    $tableWrapper.find('tbody tr:last').find('.d-dates,.d-amount').removeClass(
                                        'd-none');
                                else if (value == 'monthly') {
                                    $tableWrapper.find('tbody tr:last').find('.d-dates').removeClass(
                                        'd-none');
                                    $tableWrapper.find('tbody tr:last').find(
                                        '.d-m-amount,.d-t-d-month,.d-t-f-month').removeClass(
                                        'd-none');
                                }

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

                $(".sortableOptions").sortable({
                    items: "tr",
                    cursor: 'move',
                    opacity: 0.6,
                    update: function() {
                        updateTableFieldJson();
                    }
                });

                // $tableWrapper.find('.sortableOptions').sortable({
                //     handle: '.sort-handle',
                //     axis: 'y',
                //     helper: function(e, ui) {
                //         ui.children().each(function() {
                //             $(this).width($(this).width());
                //         });
                //         return ui;
                //     },
                //     update: function(event, ui) {
                //         updateTableFieldJson();
                //     }
                // });


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
                });

                function addItem() {
                    $tableWrapper.find('tbody').append($tableWrapper.find('tbody .clonable').clone().show().removeClass(
                        'clonable'));
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
                $tableWrapper.on('change', 'select,input', function() {
                    updateTableFieldJson();
                });

                function updateTableFieldJson() {
                    var $rows = $tableWrapper.find('tbody tr').not('.clonable');
                    var $hiddenField = $tableWrapper.find('input.array-json');

                    var json = '[';
                    var otArr = [];
                    var tbl2 = $rows.each(function(i) {
                        x = $(this).children().closest('td').find('input, select');

                        const amount = $(this).find('[data-cell-name="item.amount"]').val()
                        const cod = $(this).find('[data-cell-name="item.cod"]').val()
                        const ed = $(this).find('[data-cell-name="item.ed"]').val()
                        const m_amount = $(this).find('[data-cell-name="item.m_amount"]').val()
                        const t_d_month = $(this).find('[data-cell-name="item.t_d_month"]').val()
                        const t_f_month = $(this).find('[data-cell-name="item.t_f_month"]').val()
                        const prorated = $(this).find('[data-cell-name="item.prorated"]').val()

                        if (prorated === 'daily' && amount && cod && ed) {
                            // Calculate total days between end date and cut off date
                            const totalDays = Math.floor((new Date(ed) - new Date(cod)) / (1000 * 60 * 60 * 24));;

                            // Calculate refund amount
                            const refund = ((amount / 365) * totalDays).toFixed(2);

                            $(this).find('[data-cell-name="item.price"]').val(refund);
                            const remark = `
                                RM${amount}/365 days=RM${(amount/365).toFixed(2)}*${totalDays} Days=RM${refund} 
                            `;
                            $(this).find('[data-cell-name="item.remark"]').val(remark.trim());

                        } else if (prorated === 'monthly' && cod && ed && m_amount && t_d_month && t_f_month) {
                            // Calculate total days between end date and cut off date
                            const totalDays = Math.floor((new Date(ed) - new Date(cod)) / (1000 * 60 * 60 * 24));

                            // Calculate refund amount
                            const refund = (t_f_month * m_amount + ((m_amount / t_d_month).toFixed(2) * totalDays));

                            $(this).find('[data-cell-name="item.price"]').val(refund);
                            const remark = `
                                (RM${m_amount} X ${t_f_month} months) + (RM${(m_amount / t_d_month).toFixed(2)} X ${totalDays} days) = RM${refund}
                            `;
                            $(this).find('[data-cell-name="item.remark"]').val(remark.trim());

                        }

                        if (prorated === 'no') {
                            $(this).find('[data-cell-name="item.amount"]').val("")
                            $(this).find('[data-cell-name="item.ed"]').val("")
                            $(this).find('[data-cell-name="item.cod"]').val("")
                            $(this).find('[data-cell-name="item.m_amount"]').val("")
                            $(this).find('[data-cell-name="item.t_d_month"]').val("")
                            $(this).find('[data-cell-name="item.t_f_month"]').val("")
                        } else if (prorated === 'daily') {
                            $(this).find('[data-cell-name="item.m_amount"]').val("")
                            $(this).find('[data-cell-name="item.t_d_month"]').val("")
                            $(this).find('[data-cell-name="item.t_f_month"]').val("")
                        } else if (prorated === 'monthly') {
                            $(this).find('[data-cell-name="item.amount"]').val("")
                        }

                        var itArr = [];
                        var is_empty = false;
                        x.each(function() {
                            if (!this.value.length)
                                if (!['item.remark', 'item.ed', 'item.cod', 'item.prorated', 'item.amount', 'item.m_amount', 'item.t_d_month', 'item.t_f_month']
                                    .includes($(this).attr('data-cell-name')))
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
    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

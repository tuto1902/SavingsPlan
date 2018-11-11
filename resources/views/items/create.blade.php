@extends('layouts.app')

@section('scripts')
    <script src="/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="/vendors/validator/validator.js"></script>

    <script language="JavaScript">
        var Items = function () {
            return {
                init: function(){
                    $(document).on('click', '.add-button', function (ev) {
                        ev.preventDefault();
                        var itemsContainer = $(this).parents('#items-container');
                        var currentItem = $(this).parents('.row:first');
                        if( $(currentItem.find('input')[0]).val() != '' &&  $(currentItem.find('input')[1]).val() != '') {
                            var newEntry = $(currentItem.clone()).appendTo(itemsContainer);

                            $(newEntry.find('input')[0]).val('');
                            $(newEntry.find('input')[1]).val('').inputmask('$ 999,999,999', {numericInput: true});

                            $('#wizard').smartWizard('fixHeight');

                            $('#wizard').find('.row.item').each(function (index) {
                                $($(this).find('input')[0]).attr('name', 'items['+ index +'][label]');
                                $($(this).find('input')[1]).attr('name', 'items['+ index +'][amount]');
                                $($(this).find('input')[2]).attr('name', 'items['+ index +'][goal_id]');
                            });


                            itemsContainer.find('.row:not(:last) .add-button')
                                .removeClass('add-button').addClass('remove-button')
                                .removeClass('btn-success').addClass('btn-danger')
                                .html('<i class="fa fa-minus"></i>');
                        }
                    });

                    $(document).on('click', '.remove-button', function (ev) {
                        ev.preventDefault();
                        $(this).parents('.row:first').remove();
                        $('#wizard').smartWizard('fixHeight');
                        $('#wizard').find('.row.item').each(function (index) {
                            $($(this).find('input')[0]).attr('name', 'items['+ index +'][label]');
                            $($(this).find('input')[1]).attr('name', 'items['+ index +'][amount]');
                            $($(this).find('input')[2]).attr('name', 'items['+ index +'][goal_id]');
                        });
                    });
                }
            };
        } ();

        $(document).on('ready', function(){
            Items.init();
        });
    </script>
@endsection

@section('content')

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Saving Goals</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="/items" method="post">
                        {{ csrf_field() }}
                        <div id="wizard" class="form_wizard wizard_horizontal">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                        <span class="step_descr">
                                            Financial Stability<br>
                                            <small>Your basic monthly expenses</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                        <span class="step_descr">
                                            Financial Independence<br>
                                            <small>Monthly amount to support your current lifestyle</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                        <span class="step_descr">
                                            Financial Freedom<br>
                                            <small>Luxury items and their monthly costs</small>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="step-1">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <h3>Monthly Expenses</h3>
                                    </div>
                                </div>
                                <div id="items-container">
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[0][label]" required placeholder="Item Label" value="Rent / Mortgage">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[0][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[0][goal_id]" value="1">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[1][label]" required placeholder="Item Label" value="Food">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[1][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[1][goal_id]" value="1">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[2][label]" required placeholder="Item Label" value="Utilities">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[2][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[2][goal_id]" value="1">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 col-sm-2"></div>
                                        <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                                            <input type="text" name="items[3][label]" required="required" class="form-control" placeholder="Item Label" value="Transportation">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                                            <input type="text" name="items[3][amount]" required="required" class="form-control" placeholder="$" data-inputmask="'mask' : '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-4 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[3][goal_id]" value="1">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 col-sm-2"></div>
                                        <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                                            <input type="text" name="items[4][label]" required="required" class="form-control" placeholder="Item Label" value="Insurance">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-4 form-group">
                                            <input type="text" name="items[4][amount]" required="required" class="form-control" placeholder="$" data-inputmask="'mask' : '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-4 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[4][goal_id]" value="1">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[5][label]" required placeholder="Item Label" value="">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[5][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-success add-button"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[5][goal_id]" value="1">
                                    </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <h3>Your income sources</h3>
                                    </div>
                                </div>
                                <div id="items-container">
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[6][label]" required placeholder="Item Label" value="Salary">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[6][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-danger remove-button"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[6][goal_id]" value="2">
                                    </div>
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[7][label]" required placeholder="Item Label" value="">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[7][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-success add-button"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[7][goal_id]" value="2">
                                    </div>
                                </div>
                            </div>
                            <div id="step-3">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <h3>Your income sources</h3>
                                    </div>
                                </div>
                                <div id="items-container">
                                    <div class="row item">
                                        <div class="col-md-2 form-group"></div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[8][label]" required placeholder="Item Label" value="">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="items[8][amount]" required placeholder="$" value=""
                                                   data-inputmask="'mask': '$ 999,999,999', 'numericInput': true">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <button type="button" class="btn btn-success add-button"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <input type="hidden" name="items[8][goal_id]" value="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

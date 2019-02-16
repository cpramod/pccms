<div class="row">
    <div class="col-lg-12">
        <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-progress"></div>
                <div class="m-portlet__head-wrapper">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"></h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">

                        <a class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10"
                           href="<?php echo site_url('admin/catalog'); ?>">
                                <span>
                                    <i class="la la-arrow-left"></i>
                                    <span>Back</span>
                                </span>
                        </a>
                        <div class="btn-group">
                            <button onclick="submit();" class="btn btn-accent  m-btn m-btn--icon m-btn--wide m-btn--md"
                                    type="button">
                                <span>
                                    <i class="la la-check"></i>
                                    <span>Save</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <form id="new" method="post" action="<?php echo base_url().$this->uri->uri_string(); ?>"
                      class="m-form m-form--label-align-left- m-form--state-">
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="" class="col-xl-3 col-lg-3 col-form-label">* Title</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input class="form-control" type="text" name="key"
                                                   value="<?php echo set_value('key'); ?>" placeholder="Key"/>
                                            <span class="m-form__help">Meta key shouldn't have space</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="" class="col-xl-3 col-lg-3 col-form-label">Value</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input class="form-control" type="text" name="value"
                                                   value="<?php echo set_value('value'); ?>" placeholder="Value"/>
                                            <span class="m-form__help"></span>
                                        </div>
                                    </div>



                                </div>


                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    function submit() {
        $('#new').submit();
        return false;
    }
</script>
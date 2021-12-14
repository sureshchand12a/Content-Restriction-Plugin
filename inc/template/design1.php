<style>.modal-open{overflow-x:hidden;overflow-y:hidden}#crp_alert_modal.modal{border-radius:7px;overflow:hidden;background:#00000082;position:fixed;top:0;left:0;z-index:1050;width:100%;height:100%;outline:0}#crp_alert_modal .fade{-webkit-transition:opacity .15s linear;-o-transition:opacity .15s linear;transition:opacity .15s linear}#crp_alert_modal.modal.show .modal-dialog{-webkit-transform:none;-ms-transform:none;transform:none}#crp_alert_modal.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;transition:-webkit-transform .3s ease-out;-o-transition:transform .3s ease-out;transition:transform .3s ease-out;transition:transform .3s ease-out,-webkit-transform .3s ease-out;-webkit-transform:translate(0,-50px);-ms-transform:translate(0,-50px);transform:translate(0,-50px)}#crp_alert_modal .modal-dialog{position:relative;width:auto;margin:.5rem;pointer-events:none}@media (min-width:576px){#crp_alert_modal .modal-dialog-centered{min-height:calc(100% - 3.5rem)}}@media (min-width:576px){#crp_alert_modal .modal-dialog{max-width:420px;margin:1.75rem auto}}#crp_alert_modal .modal-dialog-centered{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;min-height:calc(100% - 1rem)}#crp_alert_modal.modal .modal-content{background-color:transparent;border:none;border-radius:7px}#crp_alert_modal .rounded-0{border-radius:0!important}#crp_alert_modal .modal-content{position:relative;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;width:100%;pointer-events:auto;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.2);border-radius:.3rem;outline:0}#crp_alert_modal.modal .modal-content .modal-body{border-radius:7px;overflow:hidden;background-color:#fff;padding-left:0;padding-right:0;-webkit-box-shadow:0 10px 50px -10px rgb(0 0 0 / 90%);box-shadow:0 10px 50px -10px rgb(0 0 0 / 90%)}#crp_alert_modal.modal .modal-content .modal-body{border-radius:7px;overflow:hidden;background-color:#fff;padding-left:0;padding-right:0;-webkit-box-shadow:0 10px 50px -10px rgb(0 0 0 / 90%);box-shadow:0 10px 50px -10px rgb(0 0 0 / 90%)}#crp_alert_modal .pl-5,#crp_alert_modal .px-5{padding-left:3rem!important}#crp_alert_modal .pr-5,#crp_alert_modal .px-5{padding-right:3rem!important}#crp_alert_modal .p-4{padding:1.5rem!important}#crp_alert_modal .modal-body{position:relative;-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto;padding:1rem}#crp_alert_modal .text-center{text-align:center!important}#crp_alert_modal.modal .modal-content .modal-body .close-btn{color:#000}#crp_alert_modal .close-btn{position:absolute;right:20px;top:20px;font-size:20px;text-decoration:none}#crp_alert_modal .close-btn span{color:#ccc}#crp_alert_modal.modal .warp-icon {width: 80px;height: 80px;margin: 0 auto;position: relative;background: <?php echo hex2rgb($settings->modalColor, 0.2); ?>;color: #3e64ff;border-radius: 50%}#crp_alert_modal.modal .warp-icon svg{font-size:40px;position:absolute;left:50%;top:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}#crp_alert_modal .mb-4,#crp_alert_modal .my-4{margin-bottom:1.5rem!important}#crp_alert_modal.modal .modal-content .modal-body p{color:#000;font-size:18px}#crp_alert_modal .d-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}#crp_alert_modal .mr-auto,#crp_alert_modal .mx-auto{margin-right:auto!important}#crp_alert_modal .btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;-webkit-transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;-o-transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;text-decoration:none}#crp_alert_modal .btn{border-radius:0;border:none;padding-left:25px;padding-right:25px}#crp_alert_modal .btn-primary {color: #fff;background-color: <?php echo $settings->modalColor; ?>; border-color: <?php echo $settings->modalColor; ?>;}</style>

<div class="modal fade" id="crp_alert_modal" style="display: none; padding-left: 17px;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-body p-4 px-5">
                <div class="main-content text-center">
                    <?php if( filter_var($settings->modalClose, FILTER_VALIDATE_BOOLEAN) ): ?>
                    <a href="javascript:void(0);" id="crpCloseBtn" class="close-btn" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                    <?php endif; ?>
                    <div class="warp-icon mb-4">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px"
                            viewBox="0 0 225.000000 225.000000" preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0.000000,225.000000) scale(0.100000,-0.100000)" fill="<?php echo $settings->modalColor; ?>"
                                stroke="none">
                                <path d="M948 2234 c-350 -54 -661 -282 -822 -601 -45 -89 -83 -203 -102 -301
-18 -95 -18 -319 0 -414 114 -595 673 -993 1266 -903 175 26 307 78 460 180
245 163 419 427 476 723 18 95 18 319 0 414 -77 400 -363 731 -743 858 -171
57 -357 72 -535 44z m349 -239 c192 -40 344 -124 474 -262 162 -172 241 -369
242 -603 1 -179 -44 -338 -135 -477 l-50 -76 -624 624 -625 624 28 23 c37 30
166 96 228 117 136 45 331 58 462 30z m346 -1593 c-42 -33 -169 -97 -243 -120
-179 -57 -372 -57 -550 0 -398 128 -659 528 -611 937 18 151 81 316 159 419
l25 33 624 -623 624 -623 -28 -23z" />
                            </g>
                        </svg>
                    </div>
                    <form action="#">
                        <p><?php echo linebreakTop($settings->restrictionMessage); ?></p>
                        <div class="d-flexs" style="margin-top:1rem;">
                            <div class="mx-auto">
                                <a href="<?php echo crp_login_url($settings->loginURL); ?>"
                                    class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
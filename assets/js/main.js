function crp_modal(action = 'show'){
    let modalContent = document.getElementById('crp_alert_modal');

    if( action == 'show' ){
        modalContent.classList.add("show");
        modalContent.style.display = "block";
        document.body.classList.add("modal-open");
    }else{
        modalContent.classList.remove("show");
        modalContent.style.display = "none";
        document.body.classList.remove("modal-open");
    }
}


const closeBtn = document.getElementById('crpCloseBtn');
if (typeof(closeBtn) != 'undefined' && closeBtn != null){
    closeBtn.onclick = function(){
        crp_modal('hide');
    };
}

(function() {
    if( typeof crpEnable != 'undefined' ){
        if( crpEnable ){
            if( crp.settings.restrictionType == 'redirect' ){
                if( crp.settings.restrictionType.length > 0 ){
                    window.location.href = crp.settings.redirectURL;
                }else{
                    crp_modal('hide')
                }
            }else{
                crp_modal('show')
            }
        }else{
            crp_modal('hide')
        }
    }else{
        crp_modal('hide')
    }
})();
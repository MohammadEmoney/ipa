let Alert = {
    init: () => {
        Alert.serviceAlert();
    },
    alert: (type, title, message, autoClose, confirmText, confirmClass, reload, redirect,autoCloseTimer) => {
        console.log(type, title, message, autoClose, confirmText, confirmClass, reload, redirect,autoCloseTimer);
        type = type ?? 'error';
        title = title ?? '';
        message = message ?? '';
        confirmClass = confirmClass ?? 'btn btn-success';
        confirmText = confirmText ?? 'Confirmed';
        autoClose = autoClose === true ? autoCloseTimer : false;
        swal({
            type: type,
            title: title,
            text: message,
            timer: autoClose,
            showCloseButton: true,
            confirmButtonClass: confirmClass,
            confirmButtonText: confirmText,
            // footer: '<a href>چرا این مشکل را دارم؟</a>',
        }).then(function (result) {
            // setTimeout(function (){
                if(reload===true){
                    location.reload();
                }
                else if(redirect!==''){
                    window.location.href = redirect;
                }
            // },1800)
        });

    },
    confirm: (type, title, message, callBackSuccess, callBackError) => {
        type = type ?? 'error';
        title = title ?? '';
        message = message ?? '';
        swal({
            title: title,
            text: message,
            type: type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-light ml-1',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                if (typeof callBackSuccess == 'function')
                    callBackSuccess()
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                if (typeof callBackError == 'function')
                    callBackError()
            }
        })

    },
    serviceAlert: () => {
        window.addEventListener('alert', (event) => {
            let {type, title, message, autoClose, confirmText, confirmClass, reload, redirect,autoCloseTimer} = event.detail[0];
            Alert.alert(type, title, message, autoClose, confirmText, confirmClass, reload, redirect,autoCloseTimer)
        });
    }
};
Alert.init();



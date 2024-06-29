let Custom = {
    init: () => {
        Custom.showModal();
        Custom.closeModal();
    },
    logout: () => {
        Alert.confirm('question', 'Logout', 'Are you willing to logout?', function () {
            Livewire.emit('logout');
        });
    },
    modalShow: (id) => {
        Livewire.emit('callModal', id);
    },
    showModal: () => {
        window.addEventListener('showModal', (event) => {
            let {name} = event.detail;
            $('#' + name).modal();
        });
    },
    closeModal: () => {
        window.addEventListener('closeModal', (event) => {
            let {name} = event.detail;
            $('#' + name).modal('hide');
        });
    },
    deleteItemList: (id, called) => {
        Alert.confirm('question', 'Are you sure you want to remove this item?', '',
            function () {
                let call_method = (called === undefined) ? 'destroy' : called;
                console.log(call_method);
                console.log(id);
                Livewire.dispatch(call_method, { id: id});
            }
        )
    },
    deleteAllItems: (called) => {
        Alert.confirm('question', 'Are you sure you want to remove all items?', '',
            function () {
                let call_method = (called === undefined) ? 'deleteAll' : called;
                console.log(call_method);
                Livewire.dispatch(call_method);
            }
        )
    },
    num2persian:()=>{
        $(document).on( 'keyup' , '.num2persian' ,function (e) {
            $(`#lbl-${e.target.id}`).html(Num2persian(e.target.value));
        });
    },
    listeners:()=>{
        $(document).on( 'keydown' , '.numeric' ,function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        $(document).on( 'keydown' , '.farsi' ,function (e) {
            if(e.key == 'Alt' || e.key == 'Shift' || e.key == 'Tab' || e.key == 'Backspace')
                return ;

            if( !e.key.match(/^[ا آ ئ ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/)){
                e.preventDefault();
            }
        });
        $(document).on( 'keydown' , '.farsi-numeric' ,function (e) {
            if(e.key == 'Alt' || e.key == 'Shift' || e.key == 'Tab' || e.key == 'Backspace')
                return ;

            if( !e.key.match(/^[0-9 ا آ ئ ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی ۰ ۱ ۲ ۳ ۴ ۵ ۶ ۷ ۸ ۹]+$/)){
                e.preventDefault();
            }
        });
        $(document).on( 'keydown' , '.english' ,function (e) {
            console.log(e.key);
            if(e.key == 'Alt' || e.key == 'Shift' || e.key == 'Tab' )
                return ;

            if( !e.key.match(/^[0-9 a-z A-Z]+$/)){
                e.preventDefault();
            }
        });
    }
};
Custom.init();

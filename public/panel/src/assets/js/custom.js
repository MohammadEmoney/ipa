let Custom = {
    init: () => {
        Custom.showModal();
        Custom.closeModal();
    },
    logout: () => {
        Alert.confirm('question', 'خروج از برنامه', 'مایل به خروج از برتامه می باشید', function () {
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
        Alert.confirm('question', 'آیتم حذف شود؟', 'تایید حذف',
            function () {
                let call_method = (called === undefined) ? 'destroy' : called;
                console.log(call_method);
                console.log(id);
                Livewire.dispatch(call_method, { id: id});
            }
        )
    },
    deleteAllItems: (called) => {
        Alert.confirm('question', 'تمام آیتم ها حذف شوند؟', 'تایید حذف',
            function () {
                let call_method = (called === undefined) ? 'deleteAll' : called;
                console.log(call_method);
                Livewire.dispatch(call_method);
            }
        )
    }
};
Custom.init();

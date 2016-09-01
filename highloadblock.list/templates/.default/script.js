/**
 * Created by kotyara on 01.09.16.
 */
BX.ready(function() {
    var rows = BX.findChildren(BX('report-result-table'), {tag:'th'}, true);
    for (i in rows)
    {
        var ds = rows[i].getAttribute('defaultSort');
        if (ds == '')
        {
            BX.addClass(rows[i], 'report-column-disabled-sort')
            continue;
        }

        BX.bind(rows[i], 'click', function(){
            var colId = this.getAttribute('colId');
            var sortType = '';

            var isCurrent = BX.hasClass(this, 'reports-selected-column');

            if (isCurrent)
            {
                var currentSortType = BX.hasClass(this, 'reports-head-cell-top') ? 'ASC' : 'DESC';
                sortType = currentSortType == 'ASC' ? 'DESC' : 'ASC';
            }
            else
            {
                sortType = this.getAttribute('defaultSort');
            }

            var idInp = BX.findChild(BX('hlblock-table-form'), {attr:{name:'sort_id'}});
            var typeInp = BX.findChild(BX('hlblock-table-form'), {attr:{name:'sort_type'}});

            idInp.value = colId;
            typeInp.value = sortType;

            BX.submit(BX('hlblock-table-form'));
        });
    }

    var editCompany = new BX.PopupWindow("my_answer", null, {
        content: BX('ajax-edit-company'),
        closeIcon: {right: "20px", top: "10px"},
        titleBar: {content: BX.create("h3", {html: '<b>Редактировать компанию</b>', 'props': {'className': 'access-title-bar'}})},
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: false},
        buttons: [
            new BX.PopupWindowButton({
                text: "Сохранить",
                className: "popup-window-button-accept",
                events: {click: function(){
                    BX.ajax.submit(BX("company-edit-form"), function(data) { // отправка данных из формы с id="myForm" в файл из action="..."
                        BX('ajax-edit-company').innerHTML = data;
                    });
                }}
            }),
            new BX.PopupWindowButton({
                text: "Отменить",
                className: "webform-button-link-cancel",
                events: {click: function(){
                    this.popupWindow.close(); // закрытие окна
                }}
            })
        ]
    });
    $('a.edit-button').click(function() {
        console.log(this);
        BX.ajax.insertToNode('?COMPANY_ID=1&ajax=y', BX('ajax-edit-company')); // функция ajax-загрузки контента из урла в #div
        editCompany.show(); // появление окна
        return false;
    });

});

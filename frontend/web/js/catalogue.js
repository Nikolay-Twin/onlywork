
/**
 * Category
 */
class Category {

    showTree() {
        $('.tree').html('');
        $.ajaxSetup({cache:false, async:false});
        $.get({
            url: '/api/v1/category-read',
            success: (data) => {
                let nestedset = new NestedSet(data);
                nestedset.create(document.querySelector('.tree'));
            },
        });
    }

    showPopupAdd(e)
    {
        $('#category-action').val('add');
        $('#category-name').val('');
        this.showPopup(e, 'Добавить');
    }

    showPopupEdit(e)
    {
        $('#category-action').val('edit');
        $('#category-name').val(e.target.dataset.name);
        this.showPopup(e, 'Изменить');
    }

    showPopup(e, action)
    {
        $('#category-action').attr('data-id', e.target.dataset.id);
        $('#category-action').html(action);
        $('.category-popup').css({ "top": e.pageY, 'left': e.pageX });
        $('.category-popup').show(200);
    }

    mogify(id, method) {
        let data = {
            'id' : id,
            'name': $('#category-name').val(),
        }
        $('#category-action').val('');
        $('.category-popup').hide(200);
        $.ajaxSetup({cache:false, async:false});
        $.ajax({
            url: '/api/v1/category',
            method: method,
            dataType: 'json',
            data: data,
            success: (response) => {
                if (response.status == 'success')
                this.showTree();
            },
        });
    }
}

/**
 * Product
 */
class Product {

    showItem(id, action) {
        $.ajaxSetup({cache:false, async:false});
        $.get({
            url: '/api/v1/product-read/'+ id,
            success: (data) => {
               this.showPopup(data, action)
            },
        });
    }

    showList(id) {
        $.ajaxSetup({cache:false, async:false});
        $.get({
            url: '/api/v1/products/'+ id,
            success: (data) => {
                $('.product-list').html('');
                if (data.length) {
                    data.forEach((item) => {
                        let edt = '<span class="product-button"  data-method="put" ' +
                            'data-id="'+ item.id  +'"> ✒ </span>';
                        let del = '<span class="product-button"  data-method="delete" ' +
                            'data-id="'+ item.id  +'" style="color: red"> 🅧 </span>';

                        $('.product-list').append(
                            '<li>' +
                            '<a href="#" data-id="'+ item.id +'" class="product-item">'+ item.name +'</a>'+
                            edt + del +
                            '</li>'
                        );
                    });
                } else {
                    $('.product-list').html('Пусто');
                }
            },
        });
    }

    showPopup(data, action)
    {
        if (action != 'get') {
            data.name = '<input type="text" id="product-name-input" value="'+ data.name +'">';
            data.description = '<textarea id="product-descript-input" >'+ data.description +'</textarea>';
        }
        $('.product-name').html(data.name);
        $('.product-description').html(data.description);
        if (action == 'add') {
            $('#product-edit-button').html('Добавить');
            $('#product-edit-button').attr('data-method', 'post');
            $('#product-edit-button').show();
        } else if (action == 'edit') {
            $('#product-edit-button').html('Редактировать');
            $('#product-edit-button').attr('data-method', 'put');
            $('#product-edit-button').show();
        } else {
            $('#product-edit-button').hide();
        }
        $('.product-popup').show(100);
    }

    mogify(id, method, data) {
        $.ajaxSetup({cache:false, async:false});
        $.ajax({
            url: '/api/v1/product',
            method: method,
            dataType: 'json',
            data: data,
            success: (response) => {
                if (response.status == 'success')
                    this.showList(id);
            },
        });
    }
}

const category = new Category();
const product = new Product();

$(document).ready(() => {
    category.showTree();
});

$('.tree').on('click', '.tree-button', (e) => {
    $('.product-popup').hide(200);
    switch (e.target.dataset.action) {
        case 'add':
            category.showPopupAdd(e);
            break;
        case 'edit':
            category.showPopupEdit(e);
            break;
        case 'delete':
            if (!confirm('Точно?')) {
                return;
            }
            category.mogify(e.target.dataset.id, 'delete');
            $('.product-list').html('');
            $('.product-add').hide()
            break;
        default:
            return;
    }
});

$('#category-action').click((e) => {
    switch (e.target.value) {
        case 'add':
            category.mogify(e.target.dataset.id, 'post');
            break;
        case 'edit':
            category.mogify(e.target.dataset.id, 'put');
            break;
        default:
            return;
    }
});

$('.tree').on('click', '.category-item', (e) => {
    e.preventDefault();
    $('#category-id').val(e.target.dataset.id);
    $('.product-add').show(200);
    product.showList(e.target.dataset.id);
});

$('.product-list').on('click', '.product-item', (e) => {
    e.preventDefault();
    product.showItem(e.target.dataset.id, 'get');
});

$('.product-add').click((e) => {
    e.preventDefault();
    $('.category-popup').hide(200);
    let data = {
        'name': '',
        'description': '',
    }
    product.showPopup(data, 'add');
});

$('.product-list').on('click', '.product-button', (e) => {
    let id = e.target.dataset.id;
    switch (e.target.dataset.method) {
        case 'put':
            $('#product-id').val(id)
            product.showItem(id, 'edit');
            break;
        case 'delete':
            if (!confirm('Точно?')) {
                return;
            }
            product.mogify(id, 'delete', {id: id});
            product.showList($('#category-id').val(), 'get');
            break;
        default:
            return;
    }
});

$('#product-edit-button').click((e) => {

    let method = e.target.dataset.method;
    let data = {
        'id' : method == 'post' ? $('#category-id').val() : $('#product-id').val(),
        'name': $('#product-name-input').val(),
        'description': $('#product-descript-input').val(),
    }
    $('#product-name-input').val(''),
    $('#product-descript-input').val(''),
    $('.product-popup').hide(200);
    product.mogify(e.target.dataset.id, method,  data);
    product.showList($('#category-id').val(), 'get');

})

$('.close-popup').click((e) => {
    $(e.target).parent().hide(200);
    $('#product-edit-button').hide();
})

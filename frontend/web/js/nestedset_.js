var arr = [
    {
        title: "Одежда",
        left: 1,
        right: 22

    },
    {
        title: "Мужская",
        left: 2,
        right: 9
    },
    {
        title: "Женская",
        left: 10,
        right: 21
    },
    {
        title: "Костюмы",
        left: 3,
        right: 8
    },
    {
        title: "Платья",
        left: 11,
        right: 16
    },
    {
        title: "Юбки",
        left: 17,
        right: 18
    },
    {
        title: "Блузы",
        left: 19,
        right: 20
    },
    {
        title: "Брюки",
        left: 4,
        right: 5
    },
    {
        title: "Жакеты",
        left: 6,
        right: 7
    },
    {
        title: "Вечерние",
        left: 12,
        right: 13
    },
    {
        title: "Летние",
        left: 14,
        right: 15
    }
];

//перегоняем массив в объект, чтобы легко брать элементы по их лефтам
var obj = {};
arr.map(item => obj[item.left] = item);

var result = {children: []};

// функция ищет всех чайлдов и помещает их в массив children объекта parentObject
// left - лефт первого чайлда
function processLevel(parentObject, left) {
    var item = obj[left];

    // если чайлд существует
    while (item) {
        //создаём для него дочерний объект с пустым массивом для возможных чайлдов этого чайлда
        var childObject = {title: item.title, children: []};

        //кладём его к братьям
        parentObject.children.push(childObject);

        //рекурсивно вызываем эту же функцию, чтобы найти всех чайлдов этого чайлда
        //лефт первого чайлда равен лефту родителя плюс один
        processLevel(childObject, item.left + 1);

        //лефт каждого следующего чайлда равен райту предыдущего плюс один
        item = obj[item.right + 1];
    }
}

// функция рендерит чайлдов объекта
function renderLevel(parentObject, node) {

    // если чайлдов нет, то не надо ничего делать
    if (parentObject.children.length === 0) return;

    // создаём список
    var ul = document.createElement('ul');
    node.appendChild(ul);

    // заполняем его чайлдами
    for (var i = 0; i < parentObject.children.length; i ++) {
        var li = document.createElement('li');
        ul.appendChild(li);
        li.innerHTML = parentObject.children[i].title;

        // рекурсивно рендерим чайлдов чайлда
        renderLevel(parentObject.children[i], li);
    }
}

processLevel(result, 1);
renderLevel(result, document.querySelector('.tree'));
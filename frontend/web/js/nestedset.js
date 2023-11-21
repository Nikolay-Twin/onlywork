
class NestedSet {
    obj = {};
    result = {children: []};

    constructor(arr) {
        arr.map(item => this.obj[item.lft] = item);
    }

    create(tree) {
        this.processLevel(this.result, 1);
        this.renderLevel(this.result, tree);
    }

    processLevel(parentObject, lft) {
        let item = this.obj[lft];
        while (item) {
            let childObject = {
                id: item.id,
                name: item.name, children: []
            };
            parentObject.children.push(childObject);
            this.processLevel(childObject, item.lft + 1);
            item = this.obj[item.rgt + 1];
        }
    }

    renderLevel(parentObject, node) {
        if (parentObject.children.length === 0) {
            return;
        }
        let ul = document.createElement('ul');
        node.appendChild(ul);
        for (let i = 0; i < parentObject.children.length; i ++) {
            let li = document.createElement('li');
            ul.appendChild(li);

            let item = parentObject.children[i];

            let add = '<span class="tree-button" data-action="add" ' +
                'data-id="'+ item.id  +'"> ✚ </span>';
            let edt = '<span class="tree-button"  data-action="edit" ' +
                'data-id="'+ item.id  +'" data-name="'+ item.name +'"> ✒ </span>';
            let del = '<span class="tree-button"  data-action="delete" ' +
                'data-id="'+ item.id  +'" style="color: red"> 🅧 </span>';

            li.innerHTML = '<a href="#" class="category-item" data-id="'+ item.id +'">'+
                item.name +'</a>'+ add + edt + del;
            this.renderLevel(item, li);
        }
    }
}

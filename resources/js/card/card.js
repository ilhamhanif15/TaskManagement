import Sortable from 'sortablejs';

const $axios = axios.create({
    baseURL: '/api',
    headers: {
	    Authorization: localStorage.getItem('token') != 'null' ? 'Bearer ' + localStorage.getItem('token'):'',
	    'Content-Type': 'application/json'
	}
});

console.log(localStorage.getItem('token'));

var list_el = $('.list-group');
var sort_list_el = [];

for (var i = 0; i < list_el.length; i++) {
	sort_list_el.push(new Sortable(list_el[i], {
	    group: 'shared',
	    animation: 150,
	    ghostClass: 'ghost',
	    onEnd: function (evt) {
			var itemEl = evt.item;  // dragged HTMLElement
			evt.to;    // target list
			evt.from;  // previous list
			evt.oldIndex;  // element's old index within old parent
			evt.newIndex;  // element's new index within new parent
			evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
			evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
			evt.clone // the clone element
			evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving
			console.log(evt.from)
			console.log(evt.to)

			var listId = parseInt($(evt.to).data('list-id').split("LS")[1]);

			return new Promise((resolve, reject) => {
				
	            $axios.get('/cardMove?list_id='+listId)
	            .then((response) => {
	                console.log(response)
	            })
	            .catch((error) => {
	                console.log(error);
	            })
	        })
		},
	}));
}
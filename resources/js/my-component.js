export default {
  data() {
    return {
      posts: []
    }
    const count = ref(0)
  },
  methods: {
          show: function () {
              axios.get('/blog').then(function (res) {
                  this.posts = res.data;
              }.bind(this));
          },
          removeRow: function(id) {
              axios.delete('/delete{id}').then(response => {
    this.result.splice(id, 1);
    console.log(this.result);
  });
          }
      },
      
      created: function () {
          this.show();
      },
  template: `
  <table class="table table-striped table-dark">
  <thead>
      <tr>
      <th class="text-left">
          ID
        </th>
        <th class="text-left">
          Name
        </th>
        <th class="text-left">
          Age
        </th>
        <th class="text-left">
          Address
        </th>
        <th class="text-left">
          Section
        </th>
        <th class="text-left">
          Salary
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in posts"
        :key="item.id"
      >
      <td>@{{ item.id }}</td>
        <td>@{{ item.name }}</td>
        <td>@{{ item.age }}</td>
        <td>@{{ item.address }}</td>
        <td>@{{ item.section }}</td>
        <td>@{{ item.salary }}</td>
        <td><a href="@{{ url('edit/'.$itemid) }}" class="btn btn-primary btn-sm">Edit</a></td>
        <td><button type="button" class="btn btn-danger" v-on:click="removeRow(item.id)">Delete</button></td>
        <button @click="count++">Add 1</button>
        <p>Count is: @{{ count }}</p>

      </tr>
    </tbody>
    </table>`
}

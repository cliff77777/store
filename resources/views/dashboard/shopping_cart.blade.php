<div class="my-5 py-5">
    <table id="example" class="table  table-sm">
        <thead>
            <tr>
                <th>商品名稱</th>
                <th>商品數量</th>
                <th>商品價格</th>
            </tr>
        </thead>
        <tbody id="product_cart_list">
            <tr>
                <td>John Doe</td>
                <td>25</td>
                <td>New York</td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": "/get_data",
                "type": "POST",
                "data": function(d) {
                    d.limit = 20;
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "phone"
                }
            ]
        });
    });
</script>

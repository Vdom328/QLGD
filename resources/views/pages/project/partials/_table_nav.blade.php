<div class="row p-3 bg-white rounded-3 ps-5 pe-5 table_container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th> 取引先コード <i class="ms-1 fas fa-sort "></i> </th>
                <th> 取引先名 <i class="ms-1 fas  fa-sort"></i> </th>
                <th> 取引先名 <i class="ms-1 fas  fa-sort"></i> </th>
                <th> 取引先名 <i class="ms-1 fas  fa-sort"></i> </th>
                <th> 取引先名 <i class="ms-1 fas  fa-sort"></i> </th>
                <th> 取引先名</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i <= 10 ; $i++)
                <tr>
                    <td>MCC001-02</td>
                    <td>2023/02/12 23:32 </td>
                    <td>2023/02/11 </td>
                    <td>XXXXXX </td>
                    <td>1.123.824</td>
                    <td><button type="button" class="btn-dark-dark">取引先コード</button></td>
                </tr>
            @endfor
        </tbody>
    </table>

</div>

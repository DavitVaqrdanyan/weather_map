<table class="table">
    <thead>
    <tr>
        <th scope="col">City</th>
        <th scope="col">Weather</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$result['name'] ?? ''}}</td>
        <td>{{$result ? $result['main']['temp_min'] :''}}</td>
    </tr>
    </tbody>
</table>

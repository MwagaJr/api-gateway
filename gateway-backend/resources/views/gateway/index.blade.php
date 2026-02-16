{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container-fluid">

    <div class="row">

        <!-- LEFT SIDE: Collections -->
        <div class="col-md-3 bg-light border-end" style="height: 100vh; overflow-y:auto;">
            <h5 class="mt-3">Collections</h5>

            @foreach($collections as $col)
                <div class="mt-3">
                    <strong>{{ $col->name }}</strong>
                    <ul class="list-group mt-2">
                        @foreach($col->requests as $req)
                            <li class="list-group-item small">
                                <span class="badge bg-primary">{{ $req->method }}</span>
                                {{ $req->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <form class="mt-3" method="POST" action="{{ route('collection.create') }}">
                @csrf
                <input type="text" name="name" class="form-control" placeholder="New Collection Name" required>
                <button class="btn btn-dark w-100 mt-2">Create</button>
            </form>
        </div>

        <!-- RIGHT SIDE: API Tester -->
        <div class="col-md-9 p-4">

            <h3>API Gateway Tester</h3>

            <!-- METHOD + URL -->
            <div class="input-group mb-3">
                <select id="method" class="form-select" style="max-width:150px;">
                    <option>GET</option>
                    <option>POST</option>
                    <option>PUT</option>
                    <option>DELETE</option>
                </select>

                <input type="text" id="url" class="form-control" placeholder="Enter API URL">
                <button class="btn btn-primary" onclick="sendRequest()">Send</button>
            </div>

            <!-- HEADERS -->
            <label>Headers (JSON)</label>
            <textarea id="headers" class="form-control" rows="2">{}</textarea>

            <!-- Query params -->
            <label class="mt-3">Query Params (JSON)</label>
            <textarea id="query_params" class="form-control" rows="2">{}</textarea>

            <!-- BODY -->
            <label class="mt-3">Body (JSON)</label>
            <textarea id="body" class="form-control" rows="4">{}</textarea>

            <button class="btn btn-success w-100 mt-3" onclick="saveRequest()">Save to Collection</button>

            <!-- RESPONSE -->
            <h4 class="mt-4">Response</h4>
            <pre id="responseBox" style="background:#111;color:#0f0;padding:20px;height:300px;overflow:auto;">Waiting...</pre>

        </div>
    </div>

</div>

<script>
function sendRequest() {
    let payload = {
        method: document.getElementById('method').value,
        url: document.getElementById('url').value,
        headers: document.getElementById('headers').value,
        query_params: document.getElementById('query_params').value,
        body: document.getElementById('body').value,
        _token: '{{ csrf_token() }}'
    };

    fetch('{{ route("gateway.send") }}', {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('responseBox').innerText =
            JSON.stringify(data, null, 2);
    })
    .catch(err => {
        document.getElementById('responseBox').innerText = err;
    });
}

function saveRequest() {
    let form = new FormData();
    form.append("collection_id", prompt("Enter Collection ID"));
    form.append("name", prompt("Enter request name"));
    form.append("method", document.getElementById('method').value);
    form.append("url", document.getElementById('url').value);
    form.append("headers", document.getElementById('headers').value);
    form.append("query_params", document.getElementById('query_params').value);
    form.append("body", document.getElementById('body').value);
    form.append("_token", '{{ csrf_token() }}');

    fetch('{{ route("gateway.save") }}', {
        method: "POST",
        body: form
    }).then(() => alert("Saved!"));
}
</script>
{{-- @endsection --}}

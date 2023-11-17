<div class="row mb-3">
    <div class="col-md">
        <label class="form-label">Client</label>
    </div>
    <div class="col-md col-md-9 col-lg-10">
        <div class="alert alert-light text-black">
            <table class="table table-sm table-borderless mb-1">
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-geo-alt"></i>
                    </td>
                    <td>
                        <span>{{ $client->street }}, {{ $client->location_country_code }}, {{ $client->zip_code }}</span>
                    </td>
                </tr>
            </table>

            <table class="table table-sm table-borderless">
                <tr>
                    <td style="width:1%">
                        <i class="bi bi-person" style="font-size:1.2rem; margin-top:-4px"></i>
                    </td>
                    <td>
                        <span class="d-block">{{ $client->fullname }}</span>
                        <span class="d-block">{{ $client->contact_info_collection->only(['phone','mobile'])->filter()->implode(', ') }}</span>
                        <span class="d-block">{{ $client->email }}</span>
                        @if( $client->notes )
                        <small class="d-block mt-1">
                            <em>{{ $client->notes }}</em>
                        </small>       
                        @endif
                    </td>
                </tr>
            </table>

            <div class="text-end">
                <a href="{{ route('clients.show', $client) }}">Go to client</a>
            </div>
        </div>
    </div>
</div>

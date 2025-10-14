@php
    set_time_limit(4000); 
    header('Set-Cookie: fileDownload=true; path=/');
    header('Cache-Control: max-age=60, must-revalidate');
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=customers-list-".time().".xls");
    header("Pragma: no-cache");
    header("Expires: 0"); 
@endphp

@if(!empty($customers) && count($customers) > 0)
    <table id="example" class="table table-striped table-bordered" style="width:100%" border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>WhatsApp Number</th>
                <th>Email</th>
                <th>City</th>
                <th>State</th>
                <th>Pincode</th>
                <th>Country</th>
                <th>Date of Birth</th>
                <th>House No</th>
                <th>Locality</th>
                <th>Landmark</th>
                <th>Shipping Address</th>
                <th>Billing Address</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ ucfirst($customer->gender) }}</td>
                    <td>{{ $customer->mobile }}</td>
                    <td>{{ $customer->whatsapp_number }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->pincode }}</td>
                    <td>{{ $customer->country }}</td>
                    <td>{{ $customer->dob ? \Carbon\Carbon::parse($customer->dob)->format('d-m-Y') : '' }}</td>
                    <td>{{ $customer->house_no }}</td>
                    <td>{{ $customer->locality }}</td>
                    <td>{{ $customer->landmark }}</td>
                    <td>{{ $customer->shipping_address }}</td>
                    <td>{{ $customer->billing_address }}</td>
                    <td>{{ $customer->status ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

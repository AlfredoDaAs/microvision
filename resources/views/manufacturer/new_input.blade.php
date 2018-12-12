<tr class="new" data-id="{{ $data_id }}">
    <td>
        <input
            type="text"
            class="form-control desc"
            name="txtDescription[{{$data_id}}]"
            placeholder="Name">
    </td>
    <td>
        <div class="form-check">
          <input type="hidden" name="status[{{$data_id}}]" value="0">
          <input class="form-check-input checkbox" type="checkbox" name="status[{{$data_id}}]" id="status{{ $data_id }}" value="1" checked>
          <label class="form-check-label" for="status{{ $data_id }}">
            {{ config('constants.status.enabled') }}
          </label>
        </div>
    </td>
    <td>
        <div class="form-check">
          <input type="hidden" name="admin[{{$data_id}}]" value="0">
          <input class="form-check-input checkbox" type="checkbox" name="admin[{{$data_id}}]" id="isAdmin{{ $data_id }}" value="1">
          <label class="form-check-label" for="isAdmin{{ $data_id }}">
            Is Admin
          </label>
        </div>
    </td>
    <td><a href="#" class="removeManufacturer" onclick="manufacturer_mgmt.removeManufacturer(this)"><i class="far fa-times-circle fa-2x"></i></a></td>
</tr>
<div class="row">
  @php
    $index = 0;
  @endphp
  @foreach ($items as $item)

    <div class="col-md-10">
      <div class="form-group">
        <label class="col-md-9 control-label"></label>
          @php
            $stringFormat =  strtolower(str_replace(' ', '', $item));
          @endphp

          <div class="col-sm-3">
            <input value="{{isset($oldVals) ? $oldVals[$index] : ''}}" type="text" class="form-control" name="<?=$stringFormat?>" id="input<?=$stringFormat?>" placeholder="Enter text and click search button">
          </div>

      </div>

    </div>
  @php
    $index++;
  @endphp
  @endforeach

 <button type="submit" class="btn btn-primary">
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      Search
    </button>
</div>
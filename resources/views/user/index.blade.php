@extends('layouts.app')

@section('content')
<div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-8">
        @include('components.statusAlert')
        <div class="card">
          <div class="card-header bg-primary text-white d-flex">
            <h5 class="font-weight-bold flex-grow-1 " style="margin-top:5px">
              使用者清單
            </h5>

            <form class="ml-auto col-md-4">
              <div class="form-group" style="margin-bottom:0px">
                <select class="form-control form-control-sm" id="seleceCheck" onchange="selectChange();">
                  <option value="" disabled selected hidden>選擇身分可篩選</option>
                  <option value="">所有身分</option>
                  @foreach($role as $r)
                    <option value="{{ $r['name'] }}">{{ $r['name'] }}</option>
                  @endforeach
                </select>
              </div>
            </form>

            <a href="{{ route('user.create') }}" class="btn ml-auto text-white btn-success font-weight-bold" role="button" aria-pressed="true">新增使用者</a>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>名稱</th>
                  <th>身分</th>
                  <th width="20%">操作</th>
                </tr>
              </thead>
              <tbody id="mainTable">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const data = JSON.parse('{!! $data->toJson() !!}');
  console.log(data)
  //篩選條件變更
  function selectChange(){
    let table = new Array();
    let seleceCheck = document.getElementById('seleceCheck').value
    if(seleceCheck == ''){
      for(let item in data){
        let value = data[item];
        for(let i = 0; i < value.length; i++){
          let d = value[i];
          table.push('<tr>')
            table.push('<td>' + d['name'] + '</td>')
            table.push('<td>' + d['role'] + '</td>')
            table.push('<td><a href="/user/'+ d['id'] +'/edit" class="btn text-white btn-primary" role="button" aria-pressed="true">修改使用者</a></td>')
          table.push('</tr>')
        }
      }
    } else if(!(seleceCheck in data)) {
      document.getElementById('mainTable').innerHTML = table.join('<span>本身分無使用者!!</span>');
    } else {
      for(let i = 0; i < data[seleceCheck].length; i++){
          let d = data[seleceCheck][i];
          table.push('<tr>')
            table.push('<td>' + d['name'] + '</td>')
            table.push('<td>' + d['role'] + '</td>')
            table.push('<td><a href="/user/'+ d['id'] +'/edit" class="btn text-white btn-primary" role="button" aria-pressed="true">修改使用者</a></td>')
          table.push('</tr>')
        }
    }
    document.getElementById('mainTable').innerHTML = table.join('');
  }


  //初始表格
  let table = new Array();
  for(let item in data){
    let value = data[item];
    for(let i = 0; i < value.length; i++){
      let d = value[i];
      table.push('<tr>')
        table.push('<td>' + d['name'] + '</td>')
        table.push('<td>' + d['role'] + '</td>')
        table.push('<td><a href="/user/'+ d['id'] +'/edit" class="btn text-white btn-primary" role="button" aria-pressed="true">修改使用者</a></td>')
      table.push('</tr>')
    }
  }
  document.getElementById('mainTable').innerHTML = table.join('');
</script>
@endsection
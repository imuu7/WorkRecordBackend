@extends('layouts.app_system')
@section('css')
<style>
    .content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #app {
        weight: 90%;
    }
</style>
@endsection
@section('content')
@php
#確認database 目錄有沒有權限
// 

$database_path = base_path()."/database";
$database_writeable = is_writable($database_path);
@endphp
@if($database_writeable == false)
<h1>請至根目錄下 給予 database 寫入權限，否則功能無法正常使用</h1>
@endif
<div id="migration">

</div>
  
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                y: true,
                y2: true,
                n: false,
                n2: false,
                nullable: true,
                unique: true,
                tableName: '',
                note: '',
                rowName: '',
                strLimit: '',
                rowType: '',
                fliers: '',
                rowData: [] //the declared array
            },
            methods: {
                addItem() {
                    var my_object = {
                        tableName: this.tableName,
                        rowName: this.rowName,
                        strLimit: this.strLimit,
                        rowType: this.rowType,
                        nullable: this.nullable,
                        unique: this.unique,
                        note: this.note,
                        id: this.rowData.length
                    };
                    this.rowData.push(my_object)

                    this.tableName = '';
                    this.rowName = '';
                    this.strLimit = '';
                    this.rowType = '';
                    this.note = '';
                    this.nullable = true;
                    this.unique = true;
                },
                deleteItem(id) {
                    this.rowData.splice(id, 1);
                },
                submit() {
                    alert('yo')
                },
            }
        })
    </script>
@endpush

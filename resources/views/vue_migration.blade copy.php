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
    <div id="app">

        <div class="row">
            <div class="col-lg-12">
                <!-- START card -->
                <div class="card card-default">
                    <div class="card-header ">
                        <div class="card-title">
                            Table 製作
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required ">
                            <label for="tableName">資料表 名稱(英文)</label>
                            <input type="text" class="form-control" required v-model="tableName" id="tableName">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                    <label for="rowName">欄位英文名稱</label>
                                    <input type="text" class="form-control" required id="rowName" v-model="rowName">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default required">
                                    <label for="rowType">屬性</label>
                                    <input type="text" class="form-control" required id="rowType" v-model="rowType">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="strLimit">字數限制</label>
                                    <input type="text" class="form-control" id="strLimit" v-model="strLimit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group  form-group-default">
                                    <label for="note">欄位備註</label>
                                    <input type="text" class="form-control" v-model="note" id="note">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio radio-success">
                                    <span>允許 Null</span>
                                    <input type="radio" v-model="nullable" v-bind:value="y" id="yes">
                                    <label for="yes"></label>
                                    <input type="radio" v-model="nullable" v-bind:value="n" id="no">
                                    <label for="no"></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="radio radio-success">
                                    <span>是否唯一</span>
                                    <input type="radio" v-model="unique" v-bind:value="y2" name="unique" id="uniqueYes">
                                    <label for="uniqueYes">Yes</label>
                                    <input type="radio" v-model="unique" v-bind:value="n2" name="unique" id="uniqueNo">
                                    <label for="uniqueNo">No</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-cons" style="margin-left: 90%;" @click="addItem">送出</button>
                    </div>
                </div>
                <!-- END card -->
            </div>
        </div>
        <div class="card card-transparent">
            <div class="card-header ">
                <div class="card-title">資料表詳情
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                            <thead>
                            <tr role="row">
                                <th style="width:1%" class="text-center sorting_disabled" rowspan="1" colspan="1"
                                    aria-label="">
                                    <button class="btn btn-link"><i class="fa fa-trash"></i>
                                    </button>
                                </th>
                                <th style="width: 213px;" class="sorting_desc" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-sort="descending"
                                    aria-label="Title: activate to sort column ascending">表英文名稱
                                </th>
                                <th style="width: 216px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Places: activate to sort column ascending">
                                    欄位英文名稱
                                </th>
                                <th style="width: 330px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Activities: activate to sort column ascending">
                                    屬性
                                </th>
                                <th style="width: 151px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">
                                    字數限制
                                </th>
                                <th style="width: 151px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Last Update: activate to sort column ascending">
                                    備註
                                </th>
                                <th style="width: 151px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Last Update: activate to sort column ascending">
                                    允許Null
                                </th>
                                <th style="width: 151px;" class="sorting" tabindex="0" aria-controls="basicTable"
                                    rowspan="1" colspan="1" aria-label="Last Update: activate to sort column ascending">
                                    是否唯一
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in rowData" role="row" class="odd">
                                <td><button class="btn btn-danger btn-cons" @click="deleteItem(item.id)">刪除</button></td>
                                <td>@{{ item.tableName }}</td>
                                <td>@{{ item.rowName }}</td>
                                <td>@{{ item.rowType }}</td>
                                <td>@{{ item.strLimit }}</td>
                                <td>@{{ item.note }}</td>
                                <td>@{{ item.nullable }}</td>
                                <td>@{{ item.unique }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <form method="POST">
                            @csrf
                            <input hidden :value="JSON.stringify(rowData)" name="data">
                            <button class="btn btn-primary" v-if="rowData.length" type="submit">送出</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

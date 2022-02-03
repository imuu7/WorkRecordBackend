import React from 'react';
import ReactDOM from 'react-dom';
import Migration_Row from '../system_components/Migration_Row';
import Migration_Config_Li from '../system_components/Migration_Config_Li';

import Example from '../components/Example';

const table_keys = [
    { "column": "欄位名稱", "val": "", 'key': 'column_name', 'val_type': "img", 'editable': true },
    { "column": "屬性類型", "val": "string", 'key': 'column_type', 'val_type': "select", "options": [{ "name": "string", 'nick': "字串" }, { "name": "text", 'nick': "長文字" }, { "name": "timestamp", 'nick': "時間" }], 'editable': true },
    { "column": "允許空值", "val": true, 'key': 'allow_null', 'editable': true,'val_type': "select", "options": [{ "name": true, 'nick': "允許" },{ "name": false, 'nick': "不允許" }] },
    { "column": "加入索引", "val": false, 'key': 'add_index', 'editable': true ,'val_type': "select", "options": [{ "name": true, 'nick': "允許" },{ "name": false, 'nick': "不允許" }] },
    { "column": "不允許重複", "val": false, 'key': 'unique', 'editable': false ,'val_type': "select", "options": [{ "name": true, 'nick': "允許" },{ "name": false, 'nick': "不允許" }] },
]

function Migration_UI() {
    const [table_name,setTableName] = React.useState(null);
    const [column_list,setColumns] = React.useState([
       
    ])
    
    const [now_columns,setNowColumns] = React.useState({});
    const [now_column_names,set_NowColumnNames] = React.useState([]);
    const [render_counter,setRenderCount] = React.useState(0);
    //init
   
    if (Object.keys(now_columns).length == 0){
        var temp_columns = {};
        table_keys.forEach(element => {
            // console.log(element)
            temp_columns[element.key] = element.val;
        });
        // console.log(temp_columns)
        setNowColumns(temp_columns);
    }
    // 
    //init end

    function Remove_Config(name){
        
        var now_list = column_list;
        var now_names = now_column_names;
        var index = now_names.indexOf(name[0]);
        // console.log(index)
        // console.log(name)
        now_list = now_list.splice(index,1);
        now_names = now_names.splice(index,1);
        // setColumns([...now_column])
        // console.log(now_list)
        // console.log(now_names)
        setRenderCount(render_counter+1)
    }
    function Add_Column(){
        var now_list = column_list;
        // console.log(now_list,"now_list")
        // setColumns([]);
        var column_names = now_column_names;
        
        var config_stat = now_columns;
        config_stat['index'] = now_list.length;
        var column_name = config_stat['column_name'];
        if(column_name==""){
            return;
        }
        if(column_names.indexOf(column_name) != -1){
            alert("欄位名稱重複");
            return 0;
        }
        column_names.push(column_name)
        // setColumns([]);
        setColumns([...column_list,JSON.parse(JSON.stringify(config_stat))]);

        set_NowColumnNames(column_names);

    }
    const table_ui_fn = function () {
        var end = [];
        table_keys.forEach(element => {
            var r = <Migration_Row column_name={element.column} column_key={element.key} key={element.key} def_val={element.val} val_type={element.val_type} options={element.options}
             onChange={
                 (e)=>{
                    var temp = now_columns;
                    temp[element.key] = e.target.value;
                    setNowColumns(temp)
                    }
            }
              />
            end.push(r)
        });
        end.push(<button key={"add_btn"} className="btn btn-info" style={{marginTop:"30px"}} onClick={()=>{Add_Column()}}>新增</button>)
        return end;
    }
    function column_list_fn(){
        var end = [];
        // console.log("column_list",column_list)
    
        column_list.forEach(element => {
            var r = <Migration_Config_Li config_data={element} key={element.column_name} Remove_Config_fn={Remove_Config}
            
              />
            end.push(r)
        });
        var table= (
            <table className="table table-bordered">
                <thead>
                <tr>
                    <th>欄位名稱</th>
                    <th>屬性類型</th>
                    <th>允許空值</th>
                    <th>加入索引</th>
                    <th>不允許重複</th>
                    <th>操作</th>
                  
                </tr>
                </thead>
                <tbody>
                  {end}
                </tbody>
            </table>
        )
        // var table = end;
        // console.log(table)
        return table;
    }
    const table_column_list_ui = column_list_fn();

    const table_ui = table_ui_fn();

    function send_table(){
        var post_data ={'table_name':table_name,'columns':column_list};
        $.ajax({
            type: 'POST',
            url: "/api/create_migration_table",
            data: post_data,
            success: function(e){
                console.log(e)
                alert('送出成功!')
            }
            
          });
    }
    return (
        <div>
            {  console.log('render')}
         
        <div className="card card-default">
            <div className="card-header ">
                <div className="card-title">
                    欄位設定
                    <br />
                    <div className={["form-group form-group-default "]}>
            <label htmlFor="rowName">表名</label>
         <input type="text" className="form-control col-12 float-left" defaultValue="" placeholder="請輸入資料表名稱" onChange={(e)=>{setTableName(e.target.value)}} />
        </div>
                </div>
            </div>
            <div className="card-body">
                {table_ui}
            </div>
        </div>   {now_column_names}
        <div className="card card-default">
            <div className="card-header ">
                <div className="card-title">
                    資訊
                    <br />
                    <button className="btn btn-success pull-right" onClick={send_table}>立即送出</button>
                </div>
            </div>
            <div className="card-body">
                {table_column_list_ui}
            </div>
        </div>
        </div>
        
    );
}

export default Migration_UI;

if (document.getElementById('migration')) {
    ReactDOM.render(<Migration_UI  />, document.getElementById('migration'));
}

import React from 'react';
import ReactDOM from 'react-dom';

function Migration_Config_Li(props) {
  
    const data_nick = {
        false:"不允許",
        true:"允許",
        'string':"字串",
        'text':"長文字",
        'timestamp':"時間"
    }

    function del_this_config(){
        // console.log(props.config_data)
        props.Remove_Config_fn(props.config_data.index)
    }
    var all_td = [];
    var all_keys = Object.keys(props.config_data)
    // console.log("#####")
    all_keys.forEach(key_name => {
        if(key_name == 'index'){
            return;
        }
        var ele = props.config_data[key_name];
        var val = ele;
        if(typeof val != 'string'){
            val = val.toString();
        }
        var val_show = val;
        if(data_nick.hasOwnProperty(val)){
            val_show = data_nick[val]
        }
        var ui = <td key={key_name}>{val_show}</td>
        
        all_td.push(ui);

    });
  
    var remove_btn = 
    (<td key={props.config_data.column_name} >
    <button className="btn btn-danger" onClick={del_this_config}>刪除</button>
    </td>)
    all_td.push(remove_btn)
    return (
        <tr>
            {all_td}
        </tr>
    );
}

export default Migration_Config_Li;

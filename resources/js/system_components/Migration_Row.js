import React from 'react';
import ReactDOM from 'react-dom';


function Migration_Row(props) {
    var has_trans_btn = true;
    var input_data = <input type="text" className="form-control col-12 float-left" onChange={props.onChange} name={props['column_key']} id={props['column_key']} style={{"borderBottom": "1px solid black",'marginBottom':"10px"}} />
    if(props.val_type=="select") {
        var options = [];
        props.options.forEach(element => {
            var opt = <option key={element.name} value={element.name}>{element.nick}</option>
            options.push(opt)
            
        });

        input_data = <select defaultValue={props.def_val} className="form-control col-12 float-left" onChange={props.onChange} name={props['column_key']} id={props['column_key']} style={{"borderBottom": "1px solid black",'marginBottom':"10px"}} >
            {options}
        </select>
        has_trans_btn = false;
    }
  
    var trans_btn = <></>
    if(has_trans_btn){
        // trans_btn = <button className="btn btn-success col-12 float-left" onClick={()=>{
        //     getTrans("hello_word")
        // }}>翻譯成英文</button>
    }
    return (
        <div className="col-2 float-left">
        <div className={["form-group form-group-default required",props.className]}>
            <label htmlFor="rowName">{props['column_name']}</label>
            {input_data}
            {trans_btn}
        </div>
    </div>
    );
}

export default Migration_Row;

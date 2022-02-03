import React from 'react';
import ReactDOM from 'react-dom';

function Example() {
    const [now_columns,setNowColumns] = React.useState(["first"]);
    const [cc,setCC] = React.useState(0);
    function add_count(){
        var now_data = now_columns;
        console.log([ ...now_columns, "hello" ])
        // now_data.push('hello')
        // console.log(now_data)
        // setNowColumns([]);
        setNowColumns([ ...now_columns, "hello" ]
            );
        var now_cc = cc;
        // setCC(now_cc+1);
    }
    const test_ui = ()=>{
        var end =[];
        var n =0;
        now_columns.forEach(element => {
            var rr = (<div key={n}>{element}</div>) 
            end.push(rr)
            n++;
        });
        console.log("end",end)
        return end;
    }
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
        {test_ui()}
                        <div className="card-body">I'm an example component! {now_columns.length}
                        <br />
                  
                        
                        
        <button onClick={add_count}>click</button>
        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}


// const Example = React.renderComponent(<Example />);
export default Example;
// if (document.getElementById('example')) {
//     ReactDOM.render(<Example />, document.getElementById('example'));
// }

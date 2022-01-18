import React from 'react';
import ReactDOM from 'react-dom';

function User() {
    const [counter, setCounter] = React.useState(0)
    const click = (direction) => {
        direction && setCounter(counter + 1)
        !direction && setCounter(counter - 1)
    }
    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>React Component in Laravel</h2></div>

                        <div className="card-body">
                            <p>I'm tiny React counter in Laravel app!</p>
                            <div style={{display: 'flex', width: '100%', justifyContent: 'center', alignItems: 'center'}}>
                                    <button onClick={() => click(true)} style={{padding: 20}}>+</button>
                                    <span style={{padding: 20}}>{counter}</span>
                                    <button onClick={() => click(false)} style={{padding: 20}}>-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default User;

// DOM element
if (document.getElementById('user')) {
    ReactDOM.render(<User />, document.getElementById('user'));
}
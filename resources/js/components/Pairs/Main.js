import React, { Component } from 'react';
import ReactDOM from 'react-dom';
 
/* Main Component */
class Main extends Component {
 
  constructor() {
   
    super();
    //Initialize the state in the constructor
    this.state = {
        pairs: [],
    }
  }
  /*componentDidMount() is a lifecycle method
   * that gets called after the component is rendered
   */
  componentDidMount() {
    /* fetch API in action */
    fetch('/api/pairs')
        .then(response => {
            return response.json();
        })
        .then(pairs => {
            //Fetched pair is stored in the state
            this.setState({ pairs });
        });
  }
 
 renderpairs() {
    return this.state.pairs.map(pair => {
        return (
            /* When using list you need to specify a key
             * attribute that is unique for each list item
            */
            <li key={pair.id} >
                { pair.number } 
            </li>      
        );
    })
  }
   
  render() {
    return (
        <div>
              <ul>
                { this.renderpairs() }
              </ul> 
            </div> 
       
    );
  }
}

export default Main;

 
if (document.getElementById('pairs')) {
    ReactDOM.render(<Main />, document.getElementById('pairs'));
}
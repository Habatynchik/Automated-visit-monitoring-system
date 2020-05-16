import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Table from '@material-ui/core/Table';

class Main extends Component{

    constructor(){
        super();
        this.state = {
            pairs: [],
        }
    }

    componentDidMount(){
        fetch('/api/pairs')
            .then(response => {
                return response.json();
            })
            .then(response => {
                this.setState({ pairs });
            })
    }

    renderPairs(){
        return this.state.pairs.map(pair => {
            return (
                <li key={pair.id}>
                    {pair.number}
                </li>
            );
        })
    }

    render(){
        return (
            <div>
                <ul>
                    { this.renderPairs() }
                </ul>
            </div>
        );
    }
}
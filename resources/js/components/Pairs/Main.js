import React, { Component, useEffect, setState, useState } from 'react';
import ReactDOM from 'react-dom';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Divider from '@material-ui/core/Divider';
import Grid from '@material-ui/core/Grid';

function Main() {
    const [pairs, setPairs] = useState([]);

    useEffect(() => {
        fetch('/api/pairs')
            .then(response => {
                return response.json();
            })
            .then(result => {
                //Fetched pair is stored in the state
                setPairs(result);
            });
    }, []);

    function renderPairs() {
        return pairs.map(pair => {
            return (
                <ListItem button key={ pair.id }>
                  <ListItemText primary={ pair.number } />
                </ListItem>
            );
        })
    }

    return (
      <div>
        <Grid container>
          
          <Grid item sm={3}></Grid>

          <Grid item sm={6}>
            <List>
               { renderPairs() }
            </List>
          </Grid>

          <Grid item sm={3}></Grid>
        </Grid>
      </div>
    );
}

export default Main;

if (document.getElementById('pairs')) {
    ReactDOM.render(<Main />, document.getElementById('pairs'));
}

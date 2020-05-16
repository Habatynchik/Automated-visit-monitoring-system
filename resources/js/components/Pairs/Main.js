import React, { Component, useEffect, setState, useState } from 'react';
import ReactDOM from 'react-dom';
import { makeStyles } from '@material-ui/core/styles';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Divider from '@material-ui/core/Divider';

const useStyles = makeStyles((theme) => ({
    root: {
        width: '100%',
        maxWidth: 360,
        backgroundColor: theme.palette.background.paper,
    },
}));

function Main(){
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
  });

  function renderPairs (){
    return pairs.map(pair => {
      return (
        <ListItem button key={ pair.id }>
          <ListItemText primary={ pair.number } />
        </ListItem>
      );
    })
  }

  const classes = useStyles();
  return(
    <div className={classes.root}>
        <List>
           { renderPairs() }
        </List>
    </div>
  );
}

export default Main;

if (document.getElementById('pairs')) {
    ReactDOM.render(<Main />, document.getElementById('pairs'));
}

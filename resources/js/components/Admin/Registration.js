import React, { Component, useEffect, setState, useState } from 'react';
import { makeStyles, useTheme } from '@material-ui/core/styles';
import ReactDOM from 'react-dom';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import PropTypes from 'prop-types';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';

function TabPanel(props) {
    const { children, value, index, ...other } = props;

    return (
        <div
      role="tabpanel"
      hidden={value !== index}
      id={`full-width-tabpanel-${index}`}
      aria-labelledby={`full-width-tab-${index}`}
      {...other}
    >
      {value === index && (
        <Box p={3}>
          <Typography>{children}</Typography>
        </Box>
      )}
    </div>
    );
}

TabPanel.propTypes = {
    children: PropTypes.node,
    index: PropTypes.any.isRequired,
    value: PropTypes.any.isRequired,
};

function a11yProps(index) {
    return {
        id: `full-width-tab-${index}`,
        'aria-controls': `full-width-tabpanel-${index}`,
    };
}

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
}));

export default function Registration() {
    const classes = useStyles();
    const theme = useTheme();
    const [value, setValue] = useState(0);
    const [groups, setGroups] = useState([]);

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    useEffect(() => {
        fetch('/api/group/getGroups')
            .then(response => {
                return response.json();
            })
            .then(result => {
                //Fetched pair is stored in the state
                setGroups(result);
            });
    }, []);

    return (
            <div className={classes.root}>
      <AppBar position="static" color="default">
        <Tabs
          value={value}
          onChange={handleChange}
          indicatorColor="primary"
          textColor="primary"
          centered
        >
          <Tab label="Викладач" {...a11yProps(0)} />
          <Tab label="Учень" {...a11yProps(1)} />
        </Tabs>
      </AppBar>
        <TabPanel value={value} index={0}>
        <div className="registr-outer">
          <form className="registr-inner">
          	<TextField id="user_name" label="Ім'я викладача" variant="outlined" className="registr_input"/>
          </form>
          </div>
        </TabPanel>
        <TabPanel value={value} index={1}>
          <div className="registr-outer">
          <form className="registr-inner">
          	<TextField id="user_name" label="Ім'я студента" variant="outlined" className="registr_input"/>
          	<TextField id="user_surname" label="Прізвище студента" variant="outlined" className="registr_input"/>
          	<TextField id="user_secondname" label="По-батькові студента" variant="outlined" className="registr_input"/>
          	<Autocomplete
		      id="combo-box-demo"
		      options={groups}
		      getOptionLabel={(option) => option.name}
		      renderInput={(params) => <TextField {...params} label="Combo box" variant="outlined" className="registr_input"/>}
		    />
          </form>
          </div>
        </TabPanel>
    </div>
  );
}

if (document.getElementById('registration')) {
    ReactDOM.render(<Registration />, document.getElementById('registration'));
}

import React, {useEffect, useState} from 'react';
import {makeStyles, useTheme} from '@material-ui/core/styles';
import ReactDOM from 'react-dom';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import PropTypes from 'prop-types';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';
import SaveIcon from '@material-ui/icons/Save';
import Button from '@material-ui/core/Button';

function TabPanel(props) {
    const {children, value, index, ...other} = props;

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
                    <Typography component={'div'}>{children}</Typography>
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
    const [value, setValue] = useState(0);
    const [groups, setGroups] = useState([]);
    const [name, setName] = useState("");
    const [surname, setSurname] = useState("");
    const [second_name, setSecond_name] = useState("");
    const [group, setGroup] = useState("");
    const [type, setType] = useState("");
    const [date, setDate] = useState(new Date());
    const [inputValue, setInputValue] = useState('');

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        if (name == "") {
            alert('Введіть ім\'я правильно!')
            return;
        } else if (surname == "") {
            alert('Введіть прізвище правильно!')
            return;
        } else if (second_name == "") {
            alert('Введіть по-батькові правильно!')
            return;
        }

        axios.post('/api/user/store', {name, surname, second_name, group, date, type})
            .then(function (response) {
                window.location.reload();
            })
            .catch(function (error) {
                alert('Щось заповнено не правильно!');
            });
    };

    useEffect(() => {
        fetch('/api/group/getGroups')
            .then(response => {
                return response.json();
            })
            .then(result => {
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
            <TabPanel value={value} index={0} onClick={e => {
                setType('1')
            }}>
                <div className="registr-outer">
                    <form onSubmit={handleSubmit} noValidate className="registr-inner register-form">
                        <TextField id="user_name" label="Ім'я викладача" variant="outlined" className="registr_input"
                                   onChange={e => {
                                       setName(e.target.value)
                                   }}/>
                        <TextField id="user_surname" label="Прізвище викладача" variant="outlined"
                                   className="registr_input" onChange={e => {
                            setSurname(e.target.value)
                        }}/>
                        <TextField id="user_secondname" label="По-батькові викладача" variant="outlined"
                                   className="registr_input" onChange={e => {
                            setSecond_name(e.target.value)
                        }}/>
                        <TextField
                            id="date"
                            label="Дата народження"
                            type="date"
                            defaultValue="2017-05-24"
                            onChange={e => {
                                setDate(e.target.value);
                            }}
                            className="registr_input input_date"
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                        <Button
                            variant="contained"
                            color="primary"
                            size="large"
                            type="submit"
                            className={classes.button}
                            startIcon={<SaveIcon/>}
                        >
                            Створити обліковий запис
                        </Button>
                    </form>
                </div>
            </TabPanel>
            <TabPanel value={value} index={1} onClick={e => {
                setType('0')
            }}>
                <div className="registr-outer">
                    <form
                        onSubmit={handleSubmit}
                        noValidate
                        className="registr-inner registr-form"
                    >
                        <TextField id="user_name" label="Ім'я студента" variant="outlined" className="registr_input"
                                   onChange={e => {
                                       setName(e.target.value)
                                   }}/>
                        <TextField id="user_surname" label="Прізвище студента" variant="outlined"
                                   className="registr_input" onChange={e => {
                            setSurname(e.target.value)
                        }}/>
                        <TextField id="user_secondname" label="По-батькові студента" variant="outlined"
                                   className="registr_input" onChange={e => {
                            setSecond_name(e.target.value)
                        }}/>
                        <Autocomplete
                            inputValue={group}
                            onInputChange={(event, newInputValue) => {
                                setGroup(newInputValue);
                            }}
                            id="combo-box-demo"
                            options={groups}
                            getOptionLabel={(option) => option.name}
                            renderInput={(params) => <TextField {...params} label="Група" variant="outlined"
                                                                className="registr_input"/>}
                        />
                        <TextField
                            id="date"
                            label="Дата народження"
                            type="date"
                            defaultValue="2017-05-24"
                            onChange={e => {
                                setDate(e.target.value);
                            }}
                            className="registr_input input_date"
                            InputLabelProps={{
                                shrink: true,
                            }}
                        />
                        <Button
                            variant="contained"
                            color="primary"
                            size="large"
                            type="submit"
                            className={classes.button}
                            startIcon={<SaveIcon/>}
                        >
                            Створити обліковий запис
                        </Button>
                    </form>
                </div>
            </TabPanel>
        </div>
    );
}

if (document.getElementById('registration')) {
    ReactDOM.render(<Registration/>, document.getElementById('registration'));
}

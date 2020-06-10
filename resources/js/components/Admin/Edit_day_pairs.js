import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import MaterialTable from 'material-table';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';

export default function Edit_day_pairs(){
    const [disciplines, setDisciplines] = useState([]);
    const [teachers, setTeachers] = useState([]);
    const [classrooms, setClassrooms] = useState([]);
    const [buildings, setBuildings] = useState([]);
    const [state, setState] = useState({
        data: [
            ]
    });

    useEffect(() => {
        fetch('/api/user/getTeachers')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setTeachers(result);
            });

        fetch('/api/discipline/getDisciplines')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setDisciplines(result);
            });

        fetch('/api/classroom/getBuildings')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setBuildings(result);
            });

        fetch('/api/classroom/getClassrooms')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setClassrooms(result);
            });
    }, []);

        return (
            <div>
                <MaterialTable
                    title="Редагування розкладу"
                    localization={{
                        toolbar: {
                            searchPlaceholder: 'Пошук'
                        },
                        header: {
                            actions: 'Можливі дії',
                        },
                        body: {
                            emptyDataSourceMessage: 'Немає даних для відображення',
                            filterRow: {
                                filterTooltip: 'Filter'
                            }
                        }
                    }}
                    options={{
                        paging: false,
                    }}
                    columns={[
                        {
                            title: "Номер пари",
                            field: "index_number",
                            lookup: { 1: "Перша пара", 2: "Друга пара", 3: "Третя пара", 4: "Четверта пара", 5: "П'ята пара", 6: "Шоста пара", 7: "Сьома пара", 8: "Восьма пара"}
                        },
                        {
                            title: "Назва дисципліни",
                            field: "discipline_name" ,
                            editComponent: props => (
                                <Autocomplete
                                    id="discipline_ac"
                                    onChange={e => props.onChange(e.target.innerText)}
                                    options={disciplines}
                                    getOptionLabel={(option) => option.name}
                                    renderInput={(params) => <TextField {...params} variant="outlined" />}
                                />
                            )
                        },
                        {
                            title: "Викладач",
                            field: "teacher",
                            editComponent: props => (
                                <Autocomplete
                                    id="teacher_ac"
                                    onChange={e => props.onChange(e.target.innerText)}
                                    options={teachers}
                                    getOptionLabel={(option) => option.surname + " " + option.name + " " + option.second_name}
                                    renderInput={(params) => <TextField {...params} variant="outlined" />}
                                />
                            )
                        },
                        {
                            title: "Корпус",
                            field: "building",
                            editComponent: props => (
                                <Autocomplete
                                    id="building_ac"
                                    onChange={e => props.onChange(e.target.innerText)}
                                    options={buildings}
                                    getOptionLabel={(option) => String(option.building_number)}
                                    renderInput={(params) => <TextField {...params} variant="outlined" />}
                                />
                            )
                        },
                        {
                            title: "Кабінет",
                            field: "classroom",
                            editComponent: props => (
                                <Autocomplete
                                    id="classroom_ac"
                                    onChange={e => props.onChange(e.target.innerText)}
                                    options={classrooms}
                                    getOptionLabel={(option) => String(option.room_number)}
                                    renderInput={(params) => <TextField {...params} variant="outlined" />}
                                />
                            )
                        }
                    ]}
                    data={state.data}
                    editable={{
                        onRowAdd: newData =>
                            new Promise(resolve => {
                                setTimeout(() => {
                                    resolve();
                                    setState(prevState => {
                                        const data = [...prevState.data];
                                        data.push(newData);
                                        return { ...prevState, data };
                                    });
                                }, 600);
                            }),
                        onRowUpdate: (newData, oldData) =>
                            new Promise(resolve => {
                                setTimeout(() => {
                                    resolve();
                                    if (oldData) {
                                        setState(prevState => {
                                            const data = [...prevState.data];
                                            data[data.indexOf(oldData)] = newData;
                                            return { ...prevState, data };
                                        });
                                    }
                                }, 600);
                            }),
                        onRowDelete: oldData =>
                            new Promise(resolve => {
                                setTimeout(() => {
                                    resolve();
                                    setState(prevState => {
                                        const data = [...prevState.data];
                                        data.splice(data.indexOf(oldData), 1);
                                        return { ...prevState, data };
                                    });
                                }, 600);
                            })
                    }}
                />
            </div>
        );
}

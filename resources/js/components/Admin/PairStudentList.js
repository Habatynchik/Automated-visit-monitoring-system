import React, {useEffect, useState} from 'react';
import MaterialTable from 'material-table';
import ReactDOM from "react-dom";
import Button from "@material-ui/core/Button";
import SaveIcon from "@material-ui/icons/Save";
import Autocomplete from "@material-ui/lab/Autocomplete";
import TextField from "@material-ui/core/TextField";
import Checkbox from "@material-ui/core/Checkbox";

export default function PairStudentList() {
    const [nowPair, setNowPair] = useState({
        data: []
    });

    const urlData = new URLSearchParams(window.location.search);

    const handleSubmit = (e) => {
        e.preventDefault();

        axios.post('/api/pair/updatePairs', {nowPair})
            .then(function (response) {
                window.location.reload();
            })
            .catch(function (error) {
                alert('Щось заповнено не правильно!');
            });
    };

    useEffect(() => {
        fetch('/api/pair/getNowPairByTeacher?idTeacher=' + urlData.get("id"))
            .then(response => {
                return response.json();
            })
            .then(result => {
                setNowPair(result);
            });
    }, []);

    const [state, setState] = React.useState({
        columns: [
            {
                title: "Наявність",
                field: "check",
                lookup: { 1: "Присутній", 0: "Відсутній"}
            },
            {title: 'Surname', editable: 'never', field: 'surname'},
            {title: 'Name', editable: 'never', field: 'name'},
            //{title: 'Second name', editable: 'never', field: 'second_name'},
            {title: 'Arrive time', editable: 'never', field: 'arrive_time'},
            {title: 'Group', editable: 'never', field: 'group_name'},
        ],

    });


    return (
        <form onSubmit={handleSubmit} noValidate className="pair-form">
            <MaterialTable
                title={urlData.get("discipline")} //номер группы
                columns={state.columns}
                data={nowPair.data}
                editable={{
                    onRowUpdate: (newData, oldData) =>
                        new Promise((resolve) => {
                            setTimeout(() => {
                                resolve();

                                if (oldData) {
                                    setNowPair((prevState) => {
                                        const data = [...prevState.data];
                                        data[data.indexOf(oldData)] = newData;
                                        return {...prevState, data};
                                    });
                                }
                            }, 600);
                        })
                }}

            />

            <Button
                variant="contained"
                color="primary"
                size="large"
                type="submit"
                startIcon={<SaveIcon/>}
            >
                Зберегти
            </Button>
        </form>
    );
}
if (document.getElementById('pair_student_list')) {
    ReactDOM.render(<PairStudentList/>, document.getElementById('pair_student_list'));
}

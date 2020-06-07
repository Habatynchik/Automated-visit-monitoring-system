import React, {useEffect, useState} from 'react';
import MaterialTable from 'material-table';
import ReactDOM from "react-dom";

export default function PairStudentList() {
    const [nowPair, setNowPair] = useState([]);

    useEffect(() => {
        fetch('/api/pair/getNowPairByTeacher?idTeacher=2')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setNowPair(result);
            });
    }, []);

    const [state, setState] = React.useState({
        columns: [
            {title: 'Name', field: 'name'},
            {title: 'Surname', field: 'surname'},
            {title: 'Birth Year', field: 'birthYear', type: 'numeric'},
            {
                title: 'Birth Place',
                field: 'birthCity',
                lookup: {34: 'İstanbul', 63: 'Şanlıurfa'},
            },
        ],
        data: [
            {name: 'Mehmet', surname: 'Baran', birthYear: 1987, birthCity: 63},
            {
                name: 'Zerya Betül',
                surname: 'Baran',
                birthYear: 2017,
                birthCity: 34,
            },
        ],
    });

    return (
        nowPair,
        <MaterialTable
            title="Editable Example" //номер группы
            columns={state.columns}
            data={state.data}
            editable={{
                onRowAdd: (newData) =>
                    new Promise((resolve) => {
                        setTimeout(() => {
                            resolve();
                            setState((prevState) => {
                                const data = [...prevState.data];
                                data.push(newData);
                                return {...prevState, data};
                            });
                        }, 600);
                    }),
                onRowUpdate: (newData, oldData) =>
                    new Promise((resolve) => {
                        setTimeout(() => {
                            resolve();
                            if (oldData) {
                                setState((prevState) => {
                                    const data = [...prevState.data];
                                    data[data.indexOf(oldData)] = newData;
                                    return {...prevState, data};
                                });
                            }
                        }, 600);
                    })
            }}

        />

    );
}
if (document.getElementById('pair_student_list')) {
    ReactDOM.render(<PairStudentList/>, document.getElementById('pair_student_list'));
}

import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import Grid from "@material-ui/core/Grid";

export default function Edit_schedule(){
    const [faculties, setFaculties] = useState([]);
    const [facultyID, setFacultyID] = useState();
    const [departments, setDepartments] = useState([]);
    const [departmentID, setDepartmentID] = useState();
    const [groups, setGroups] = useState([]);
    const [groupID, setGroupID] = useState();

    useEffect(() => {
        fetch('/api/faculty/getFaculties')
            .then(response => {
                return response.json();
            })
            .then(result => {
                setFaculties(result);
            });
    }, []);

    function renderFaculties() {
        return faculties.map(faculty => {
            return (
                <Button onClick={setFacultyID(faculty.id)}>
                    {faculty.name}
                </Button>
            );
        })
    }

    function renderDepartments(){
        fetch('/api/department/getDepartments?by=faculty_id&value=' + facultyID)
            .then(response => {
                return response.json();
            })
            .then(result => {
                setDepartments(result);
            });

        return departments.map(department => {
            return(
                <Button onClick={setDepartmentID(department.id)}>
                    {department.name}
                </Button>
            );
        })
    }

    function renderGroups(){
        fetch('/api/faculty/getDepartments?by=id&value=' + facultyID)
            .then(response => {
                return response.json();
            })
            .then(result => {
                setGroups(result);
            });

        return groups.map(group => {
            return(
                <Button onClick={setGroupID(group.id)}>
                    {group.name}
                </Button>
            );
        })
    }

    return(
        <Grid container id="faculties_schedule">
            <Grid item sm={3}></Grid>
            <Grid item sm={6}>
                <ButtonGroup
                    variant="contained"
                    color="primary"
                    aria-label="contained primary button group"
                    style={{
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center"
                    }}>
                    {renderFaculties()}
                </ButtonGroup>
                <div id="departments_schedule">
                    <ButtonGroup
                        variant="contained"
                        color="primary"
                        aria-label="contained primary button group"
                        style={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center"
                        }}>
                        {renderFaculties()}
                    </ButtonGroup>
                </div>
                <div id="groups_schedule">
                    <ButtonGroup
                        variant="contained"
                        color="primary"
                        aria-label="contained primary button group"
                        style={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center"
                        }}>
                        {renderFaculties()}
                    </ButtonGroup>
                </div>
            </Grid>
            <Grid item sm={3}></Grid>
        </Grid>
    );
}

if (document.getElementById('edit_schedule')) {
    ReactDOM.render(<Edit_schedule/>, document.getElementById('edit_schedule'));
}

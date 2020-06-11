import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import Grid from "@material-ui/core/Grid";
import Edit_day_pairs from "./Edit_day_pairs";

export default function Edit_schedule(){
    const [faculties, setFaculties] = useState([]);
    const [facultyID, setFacultyID] = useState();
    const [showDepartments, setShowDepartments] = useState(false);
    const [departments, setDepartments] = useState([]);
    const [departmentID, setDepartmentID] = useState();
    const [showGroups, setShowGroups] = useState(false);
    const [groups, setGroups] = useState([]);
    const [groupID, setGroupID] = useState();
    const [showWeeks, setShowWeeks] = useState(false);
    const [week, setWeek] = useState();
    const [showDays, setShowDays] = useState(false);
    const [day, setDay] = useState();
    const [showSchedule, setShowSchedule] = useState(false);
    let controller = new AbortController();
    let signal = controller.signal;

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
                <Button key={"facultyID" + faculty.id} onClick={() => updateDepartment(faculty.id)}>
                    {faculty.name}
                </Button>
            );
        })
    }

    function updateDepartment(id){
        setFacultyID(id);
        setShowGroups(false);
        setShowDepartments(true);
        setShowWeeks(false);
        setShowDays(false);
        setShowSchedule(false);
    }

    function renderDepartments(){
        fetch('/api/department/getDepartments?by=faculty_id&value=' + facultyID)
            .then(response => {
                return response.json();
            })
            .then(result => {
                setDepartments(result);
            });

        function renderButtons() {
            return departments.map(department => {
                return (
                    <Button key={"departmentID" + department.id} onClick={() => updateGroups(department.id)}>
                        {department.name}
                    </Button>
                );
            })
        }

        return (
            <ButtonGroup
                variant="contained"
                color="primary"
                aria-label="contained primary button group"
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                }}>
                {renderButtons()}
            </ButtonGroup>
        )
    }

    function updateGroups(id){
        setDepartmentID(id);
        setShowGroups(true);
        setShowWeeks(false);
        setShowDays(false);
        setShowSchedule(false);
    }

    function renderGroups(){
        fetch('/api/group/getGroups?by=id_department&value=' + facultyID)
            .then(response => {
                return response.json();
            })
            .then(result => {
                setGroups(result);
            });

        function renderButtons(){
            return groups.map(group => {
                return(
                    <Button key={"groupID" + group.id} onClick={updateWeeks}>
                        {group.name}
                    </Button>
                );
            })
            controller.abort();
        }

        return(
            <ButtonGroup
                variant="contained"
                color="primary"
                aria-label="contained primary button group"
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                }}>
                {renderButtons()}
            </ButtonGroup>
        );
    }

    function updateWeeks(){
        setShowWeeks(true);
        setShowDays(false);
        setShowSchedule(false);
    }

    function renderWeeks(){
        return(
            <ButtonGroup
                variant="contained"
                color="primary"
                aria-label="contained primary button group"
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                }}>
                <Button key={"weekUP"} onClick={() => updateDays(1)}>
                    Верхній тиждень
                </Button>
                <Button key={"weekDOWN"} onClick={() => updateDays(0)}>
                    Нижній тиждень
                </Button>
            </ButtonGroup>
        );
    }

    function updateDays(id){
        setWeek(id);
        setShowDays(true);
        setShowSchedule(false);
    }

    function renderDays(){
        return(
            <ButtonGroup
                variant="contained"
                color="primary"
                aria-label="contained primary button group"
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                }}>
                <Button key={"monday"} onClick={() => updateSchedule(1)}>
                    Понеділок
                </Button>
                <Button key={"tuesday"} onClick={() => updateSchedule(2)}>
                    Вівторок
                </Button>
                <Button key={"wensday"} onClick={() => updateSchedule(3)}>
                    Середа
                </Button>
                <Button key={"thursday"} onClick={() => updateSchedule(4)}>
                    Четвер
                </Button>
                <Button key={"friday"} onClick={() => updateSchedule(5)}>
                    П'ятниця
                </Button>
                <Button key={"saturday"} onClick={() => updateSchedule(6)}>
                    Субота
                </Button>
            </ButtonGroup>
        );
    }

    function updateSchedule(id){
        setDay(id);
        setShowSchedule(true);
    }

    function renderSchedule(){

        function renderButtons(){
            return groups.map(group => {
                return(
                    <Button key={"groupID" + group.id} onClick={updateWeeks}>
                        {group.name}
                    </Button>
                );
            })
        }

        return(
            <ButtonGroup
                variant="contained"
                color="primary"
                aria-label="contained primary button group"
                style={{
                    display: "flex",
                    justifyContent: "center",
                    alignItems: "center"
                }}>
                {renderButtons()}
            </ButtonGroup>
        );
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
                    {
                        showDepartments && renderDepartments()
                    }
                </div>
                <div id="groups_schedule">
                    {
                        showGroups && renderGroups()
                    }
                </div>
                <div id="weeks_schedule">
                    {
                        showWeeks && renderWeeks()
                    }
                </div>
                <div id="days_schedule">
                    {
                        showDays && renderDays()
                    }
                </div>
                <div>
                    {
                        showSchedule && <Edit_day_pairs />
                    }
                </div>
            </Grid>
            <Grid item sm={3}></Grid>
        </Grid>
    );
}

if (document.getElementById('edit_schedule')) {
    ReactDOM.render(<Edit_schedule/>, document.getElementById('edit_schedule'));
}



import './App.css'
import { useState, useEffect } from "react";
import axios from "axios";

function App() {
  const [crewname, setName] = useState("");
  const [crewId, setCrewId] = useState("");
  const [flightNumber, setFlightNumber] = useState("");
  const [flightDate, setFlightDate] = useState("");
  const [aircraftType, setAircraftType] = useState("");
  const [passengers, setPassengers] = useState([]);

  useEffect(() => {
    fetchPassengers();
  }, []);

  const fetchPassengers = async () => {
    try {
      const response = await axios.get(
        "http://127.0.0.1:8000/api/passengers"
      );

      setPassengers(response.data);
    } catch (error) {
      console.error(error);
    }
  };

  const generateSeat = async () => {
    try {
      const response = await axios.post("http://127.0.0.1:8000/api/check", {
        flight_number: flightNumber,
        flight_date: flightDate,
      });
      console.log(response.data);
      console.log(response.data.has_assigned_vouchers);
      if (response.data.has_assigned_vouchers === false) {
        const secondresponse = await axios.post("http://127.0.0.1:8000/api/generate", {
          crew_name: crewname,
          crew_id: crewId,
          flight_number: flightNumber,
          flight_date: flightDate,
          aircraft_type: aircraftType,
        });
        alert(`Successfully generated seat: ${JSON.stringify(secondresponse.data)}`);
        fetchPassengers(); // Refresh the passenger list after adding a new passenger
      }
      else {
        alert("Vouchers have already been assigned for this flight.");
      }
    } catch (error) {
      console.error("Error adding passenger:", error);
    }
  };

  return (
    <>
      <section id="center">
        <div>
          <h1>Airline Voucher Seat Assignment</h1>
          <form className='ui form'>
            <div className='fields'>
              <div className='four wide field'>
                <label> Crew Name: </label> 
                <input type="text" className="custom-select" name='crew_name' placeholder='Crew Name' value={crewname} onChange={(e) => setName(e.target.value)}/> 
              </div>
              <div className='four wide field'>
                <label> Crew ID: </label> 
                <input type="text" className="custom-select" name='crew_id' placeholder='Crew ID' value={crewId} onChange={(e) => setCrewId(e.target.value)}/> 
              </div>
              <div className='four wide field'>
                <label> Flight Number: </label> 
                <input type="text" className="custom-select" name='flight_number' placeholder='Flight Number' value={flightNumber} onChange={(e) => setFlightNumber(e.target.value)}/> 
              </div>
              <div className='four wide field'>
                <label> Flight Date: </label> 
                <input type="date" className="custom-select" name='flight_date' placeholder='Flight Date' value={flightDate} onChange={(e) => setFlightDate(e.target.value)}/> 
              </div>
              <div className='four wide field'>
                <label> Aircraft Type: </label> 
                <select class="custom-select" value={aircraftType} onChange={(e) => setAircraftType(e.target.value)}>
                  <option value="" selected disabled>Select Aircraft Type</option>
                  <option value="ATR" >ATR</option>
                  <option value="Airbus 320">Airbus 320</option>
                  <option value="Boeing 737 Max">Boeing 737 Max</option>
                </select>
              </div>
            </div >
            <br />
            <button type="button" className="counter" onClick={generateSeat}>
              Generate Seat
            </button>
          </form>
        </div>
      </section>

      <div className="ticks"></div>

      <section id="center">
        <div className="validated voucher">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Crew Name</th>
                <th>Crew ID</th>
                <th>Flight Number</th>
                <th>Flight Date</th>
                <th>Aircraft Type</th>
                <th>seat1</th>
                <th>seat2</th>
                <th>seat3</th>
              </tr>
            </thead>
            <tbody>
              {passengers.map((passenger) => (
                <tr key={passenger.id}>
                  <td>{passenger.id}</td>
                  <td>{passenger.crew_name}</td>
                  <td>{passenger.crew_id}</td>
                  <td>{passenger.flight_number}</td>
                  <td>{passenger.flight_date}</td>
                  <td>{passenger.aircraft_type}</td>
                  <td>{passenger.seat1}</td>
                  <td>{passenger.seat2}</td>
                  <td>{passenger.seat3}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </section>

      <div className="ticks"></div>
      <section id="spacer"></section>
    </>
  )
}

export default App

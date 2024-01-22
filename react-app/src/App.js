import './App.css';
import {Route, BrowserRouter, Routes} from "react-router-dom";
import SignIn from "./SignIn";
import ProviderCallback from "./ProviderCallback";

function App() {
  return (
      <BrowserRouter>
          <Routes>
              <Route path="/" element={<SignIn />}></Route>
              <Route path="/auth/github" element={<ProviderCallback />}></Route>
          </Routes>

          Meu campeonato
      </BrowserRouter>
  );
}

export default App;
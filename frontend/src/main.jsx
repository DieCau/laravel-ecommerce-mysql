import { createRoot } from 'react-dom/client'
import App from './App.jsx'

import 'bootstrap-icons/font/bootstrap-icons.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'react-image-gallery/styles/css/image-gallery.css'
import 'react-toastify/dist/ReactToastify.css'

import './index.css'

import { Provider } from 'react-redux'
import { ToastContainer } from 'react-toastify'
import { store } from './redux/store'

createRoot(document.getElementById('root')).render(
  <Provider store={store}>
    <PersistGate persitor={persistor}>
      <div className='container card shadow-sm my-4'>
        <ToastContainer position='right' />
        <App />
      </div>,
    </PersistGate>
  </Provider>
)

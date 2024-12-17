import { RotatingLines } from 'react-loader-spinner'

export default function Spinner() {
  return (
    <div className="d-flex justify-content-center align-items-center my-5">
      <RotatingLines
        visible={true}
        height="100"
        width="100"
        color="#133E87"
        strokeWidth="5"
        animationDuration="0.75"
        ariaLabel="rotating-lines-loading"
      />
    </div>
  )
}

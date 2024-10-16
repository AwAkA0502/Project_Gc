import React, { useState } from 'react';
import axios from 'axios';

const CreateClassForm = () => {
  const [className, setClassName] = useState('');
  const [subjectName, setSubjectName] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/api/classes/create', {
        className,
        subjectName
      });
      alert(`Class created with code: ${response.data.classCode}`);
    } catch (error) {
      console.error('There was an error creating the class!', error);
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <label>
        Nama Kelas:
        <input
          type="text"
          value={className}
          onChange={(e) => setClassName(e.target.value)}
        />
      </label>
      <br/>
      <label>
        Nama Pelajaran:
        <input
          type="text"
          value={subjectName}
          onChange={(e) => setSubjectName(e.target.value)}
        />
      </label>
      <br/>
      <button type="submit">Buat</button>
    </form>
  );
};

export default CreateClassForm;

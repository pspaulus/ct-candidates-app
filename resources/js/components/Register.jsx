import React, { useState } from 'react';
import { Container, TextField, Button, Alert, Typography, Box } from '@mui/material';
import { useNavigate } from 'react-router-dom'; 
import axios from '../axios/axios'

const Register = () => {
  const [messageAlert, setMessageAlert] = useState({})
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
  });
  const navigate = useNavigate();

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/register', formData);
      if(response.data.ok){
        const token = response.data.token;
        localStorage.setItem('token', token);
        navigate('/tasks');
      }
    } catch (error) {
      setMessageAlert(error.response.data);
    }
  };
  
  
  return (
    <Container maxWidth="xs">
      <Box
        sx={{
          marginTop: 8,
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
        }}
      >
        <Typography component="h1" variant="h5">
          Register
        </Typography>
        <Box component="form" noValidate sx={{ mt: 1 }} onSubmit={handleSubmit}>
          <TextField
            margin="normal"
            required
            fullWidth
            id="name"
            label="Name"
            name="name"
            autoComplete="name"
            autoFocus
            value={formData.name}
            onChange={handleChange}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            id="email"
            label="Email Address"
            name="email"
            autoComplete="email"
            value={formData.email}
            onChange={handleChange}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            name="password"
            label="Password"
            type="password"
            id="password"
            autoComplete="current-password"
            value={formData.password}
            onChange={handleChange}
          />

          {Object.keys(messageAlert).length > 0 && (
                Object.keys(messageAlert).map((key, index) => (
                  <Alert key={index} style={{marginBlock:'2px'}} severity="error">
                    {messageAlert[key]}
                  </Alert>
                ))
              )}

          <Button
            type="submit"
            fullWidth
            variant="contained"
            sx={{ mt: 3, mb: 2 }}
          >
            Register
          </Button>
        </Box>
      </Box>
    </Container>
  );
};

export default Register;

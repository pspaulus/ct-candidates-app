import React, { useState } from 'react';
import { Container, Button, Box } from '@mui/material';
import Login from './components/Login';
import Register from './components/Register';

const Index = () => {
  const [isLogin, setIsLogin] = useState(true);

  const toggleAuthMode = () => {
    setIsLogin(!isLogin);
  };

  return (
    <Container component="main" maxWidth="xs">
      <Box
        sx={{
          marginTop: 8,
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
        }}
      >
        {isLogin ? <Login /> : <Register />}
        <Button
          onClick={toggleAuthMode}
          sx={{ mt: 2 }}
        >
          {isLogin ? "Don't have an account? Register" : 'Already have an account? Login'}
        </Button>
      </Box>
    </Container>
  );
};

export default Index;

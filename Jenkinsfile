
pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = 'student-management'
    }

    stages {
        stage('Checkout') {
            steps {
                echo 'Code checked out from GitHub'
                checkout scm
            }
        }

        stage('Build Docker Images') {
            steps {
                sh 'docker compose build'
            }
        }

        stage('Deploy Application') {
            steps {
                sh 'docker compose up -d'
            }
        }

        stage('Database Migration') {
            steps {
                sh 'docker compose exec -T app php artisan migrate --force'
            }
        }

        stage('Verify Website') {
            steps {
                sh 'curl --retry 10 --retry-delay 3 --retry-connrefused -fsS http://127.0.0.1:8081/'
            }
        }
    }
}


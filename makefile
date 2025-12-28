all: test-project

.PHONY=test-project

test-project:
	docker compose -f ./docker/docker-compose.yml up --exit-code-from php-cli --build && docker compose down